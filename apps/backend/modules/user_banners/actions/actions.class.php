<?php

require_once dirname(__FILE__) . '/../lib/user_bannersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/user_bannersGeneratorHelper.class.php';

/**
 * user_banners actions.
 *
 * @package    stgcms2
 * @subpackage user_banners
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class user_bannersActions extends autoUser_bannersActions
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
            $this->redirect('@user_banners');
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
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName)
                        )
                        {
                            unlink(sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName);
                        }
                    }

                    $pictures = $form->save();
                    if($file['file']['type'] != 'application/x-shockwave-flash')
                    {                        
                        //XXX Miniaturki
                        if ($this->makeThumbnails($pictures, $file['file']))
                        {
                            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));
                            if ($request->hasParameter('_save_and_add'))
                            {
                                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                                $this->redirect('@user_banners_new');
                            }
                            else
                            {
                                $this->getUser()->setFlash('notice', $notice);
                                $this->redirect(array('sf_route' => 'user_banners_edit', 'sf_subject' => $pictures));
                            }
                        }
                        else
                        {
                            $this->getUser()->setFlash('error', 'Nie można dodać obrazka');
                            $this->redirect(array('sf_route' => 'user_banners_edit', 'sf_subject' => $pictures));
                        }
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
                ->from('UserBanners')
                ->whereIn('user_banner_id', $ids)
                ->execute();

        foreach ($objects as $key => $object)
        {
            if ($object->getFile() != '')
            {
                $fileName = $object->getFile();
                unlink(sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName);
                if(substr($fileName, -4) != '.swf')
                {
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName);
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName);
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName);
                }
            }
        }

        $count = Doctrine_Query::create()
                ->delete()
                ->from('UserBanners')
                ->whereIn('user_banner_id', $ids)
                ->execute();

        if ($count >= count($ids))
        {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        }
        else
        {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }

        $this->redirect('@user_banners');
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
        if(substr($fileName, -4) == '.swf')
        {
            if(unlink(sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName))
            {
                $this->getRoute()->getObject()->delete();
                $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
                $this->redirect('@user_banners');
            }
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('error', 'Nie można było usunąć pliku obrazu z serwera. Obrazek został usunięty z bazy danych (jeśli jego plik nie istnieje, to nie powinien się wyświetlać). Sprawdź uprawnienia do katalogu z obrazkami.');
            $this->redirect('@user_banners');

        }
        else
        {
            if (
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName) &&
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName) &&
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName) &&
                    unlink(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName)
            )
            {
                $this->getRoute()->getObject()->delete();
                $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
                $this->redirect('@user_banners');
            }
            else
            {
                $this->getRoute()->getObject()->delete();
                $this->getUser()->setFlash('error', 'Nie można było usunąć pliku obrazu z serwera. Obrazek został usunięty z bazy danych (jeśli jego plik nie istnieje, to nie powinien się wyświetlać). Sprawdź uprawnienia do katalogu z obrazkami.');
                $this->redirect('@user_banners');
            }
        }
        /**
         *
         */
    }

    protected function makeThumbnails($picture, $file = false)
    {
        $fileName = $picture->getFile();
        $filePath = sfConfig::get('sf_upload_dir') . '/user_banners/' . $fileName;
        if (file_exists($filePath))
        {

            $settings = stgConfig::getGroup('BANNERS');

            //$picSettings = sfConfig::get('mod_user_banners_settings_picture');
            //$thumbSettings = sfConfig::get('mod_user_banners_settings_thumbnail');


            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['banners_thumbnail_min_width'], $settings['banners_thumbnail_min_height'], true, $settings['banners_thumbnail_min_inflate'], $settings['banners_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName);

            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['banners_thumbnail_max_width'], $settings['banners_thumbnail_max_height'], true, $settings['banners_thumbnail_max_inflate'], $settings['banners_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName);


            //origninal
            
            if($file)
            {
                move_uploaded_file($file['tmp_name'], sfConfig::get('sf_upload_dir') . '/user_banners/original/'.$fileName);
            }
            else
            {
                $thumbnail = new sfThumbnail(null, null, false, true);
                $thumbnail->loadFile($filePath);
                $thumbnail->save(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName);
            }
            
            //Picture
            $thumbnail = new sfThumbnail($settings['banners_picture_width'], $settings['banners_picture_height'], true, $settings['banners_picture_inflate'], $settings['banners_picture_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save($filePath);


            if (
            file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/min/' . $fileName) &&
                    file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/max/' . $fileName) &&
                    file_exists(sfConfig::get('sf_upload_dir') . '/user_banners/original/' . $fileName)
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
        $this->getUser()->setFlash('notice', 'Banner zmieniony pomyślnie');
        $this->redirect('user_banners');
    }

}
