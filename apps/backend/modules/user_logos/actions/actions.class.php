<?php

require_once dirname(__FILE__) . '/../lib/user_logosGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/user_logosGeneratorHelper.class.php';

/**
 * user_logos actions.
 *
 * @package    stgcms2
 * @subpackage user_logos
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class user_logosActions extends autoUser_logosActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $sorts = $this->getSort();
        if (empty($sorts[0]))
        {
            $sorts[0] = 'is_active';
            $sorts[1] = 'desc';
        }
        $this->setSort($sorts);
        parent::executeIndex($request);
        $this->setTemplate('index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $file = $request->getFiles($form->getName());
        $quota = stgConfig::get('system_user_quota');
        $current = T::du(sfConfig::get('sf_upload_dir'));

        if (($file['file']['size'] > 0) && ($file['file']['size'] + $current) >= $quota)
        {
            $this->getUser()->setFlash('error', 'Nie masz już miejsca na dodawanie bannerów. Spróbuj dodać mniejszy.');
            $this->redirect('@user_logos');
        }
        else
        {
            if ($file['file']['size'] == 0)
            {
                parent::processForm($request, $form);
            }
            else
            {
                $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
                if ($form->isValid())
                {
                    $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                    if (!$form->getObject()->isNew())
                    {
                        $fileName = $form->getObject()->getFile();
                        if (
                        $fileName != '' &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName)
                        )
                        {
                            unlink(sfConfig::get('sf_upload_dir') . '/user_logos/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName);
                        }
                    }

                    $pictures = $form->save();

                    //XXX Miniaturki
                    if ($this->makeThumbnails($pictures))
                    {
                        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));
                        if ($request->hasParameter('_save_and_add'))
                        {
                            $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                            $this->redirect('@user_logos_new');
                        }
                        else
                        {
                            $this->getUser()->setFlash('notice', $notice);
                            $this->redirect(array('sf_route' => 'user_logos_edit', 'sf_subject' => $pictures));
                        }
                    }
                    else
                    {
                        $this->getUser()->setFlash('error', 'Nie można dodać obrazka');
                        $this->redirect(array('sf_route' => 'user_logos_edit', 'sf_subject' => $pictures));
                    }
                }
                else
                {
                    $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
                }
            }
        }
    }

    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');

        $objects = Doctrine_Query::create()
                ->from('UserLogos')
                ->whereIn('user_logo_id', $ids)
                ->execute();

        foreach ($objects as $key => $object)
        {
            if ($object->getFile() != '')
            {
                $fileName = $object->getFile();
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/' . $fileName);
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName);
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName);
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName);
            }
        }

        $count = Doctrine_Query::create()
                ->delete()
                ->from('UserLogos')
                ->whereIn('user_logo_id', $ids)
                ->execute();

        if ($count >= count($ids))
        {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        }
        else
        {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }
        $this->redirect('@user_logos');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $picture = $this->getRoute()->getObject();
        $fileName = $picture->getFile();

        //$request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        /**
         * XXX Kasowanie plików z serwera
         */
        if (
        unlink(sfConfig::get('sf_upload_dir') . '/user_logos/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName)
        )
        {
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            $this->redirect('@user_logos');
        }
        else
        {
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('error', 'Nie można było usunąć pliku obrazu z serwera. Obrazek został usunięty z bazy danych (jeśli jego plik nie istnieje, to nie powinien się wyświetlać). Sprawdź uprawnienia do katalogu z obrazkami.');
            $this->redirect('@user_logos');
        }
        /**
         *
         */
    }

    protected function makeThumbnails($picture)
    {
        $fileName = $picture->getFile();
        $filePath = sfConfig::get('sf_upload_dir') . '/user_logos/' . $fileName;
        if (file_exists($filePath))
        {
            //$picSettings = sfConfig::get('mod_user_logos_settings_picture');
            //$thumbSettings = sfConfig::get('mod_user_logos_settings_thumbnail');

            $settings = stgConfig::getGroup('LOGOS');

            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['logos_thumbnail_min_width'], $settings['logos_thumbnail_min_height'], true, $settings['logos_thumbnail_min_inflate'], $settings['logos_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName);

            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['logos_thumbnail_max_width'], $settings['logos_thumbnail_max_height'], true, $settings['logos_thumbnail_max_inflate'], $settings['logos_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName);

            //Picture
            $thumbnail = new sfThumbnail($settings['logos_picture_width'], $settings['logos_picture_height'], true, $settings['logos_picture_inflate'], $settings['logos_picture_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save($filePath);

            $thumbnail = new sfThumbnail(null, null, true, $settings['logos_picture_inflate']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName);

            if (
                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/min/' . $fileName) &&
                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/max/' . $fileName) &&
                file_exists(sfConfig::get('sf_upload_dir') . '/user_logos/original/' . $fileName)
            )
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function executeSwitchActive(sfWebRequest $request)
    {
        $object = $this->getRoute()->getObject();
        $object->switchActive();
        $this->getUser()->setFlash('notice', 'Nagłówek zmieniony pomyślnie');
        $this->redirect('user_logos');
    }
}
