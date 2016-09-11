<?php

require_once dirname(__FILE__).'/../lib/iconGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/iconGeneratorHelper.class.php';

/**
 * icon actions.
 *
 * @package    sell4
 * @subpackage icon
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class iconActions extends autoIconActions {

    public function executeIndex(sfWebRequest $request) {
        $sorts = $this->getSort();
        if (empty($sorts[0])) {
            $sorts[0] = 'is_active';
            $sorts[1] = 'desc';
        }
        $this->setSort($sorts);
        parent::executeIndex($request);
        $this->setTemplate('index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $file = $request->getFiles($form->getName());
        $quota = stgConfig::get('system_user_quota');
        $current = T::du(sfConfig::get('sf_upload_dir'));

        if (($file['file']['size'] > 0) && ($file['file']['size'] + $current) >= $quota) {
            $this->getUser()->setFlash('error', 'Nie masz już miejsca na dodawanie bannerów. Spróbuj dodać mniejszy.');
            $this->redirect('@icon');
        }
        else {
            if ($file['file']['size'] == 0) {
                parent::processForm($request, $form);
            }
            else {
                $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
                if ($form->isValid()) {

                    $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                    if (!$form->getObject()->isNew()) {
                        $fileName = $form->getObject()->getFile();
                        if (
                        $fileName != '' &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/icons/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName) &&
                                file_exists(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName)
                        ) {
                            unlink(sfConfig::get('sf_upload_dir') . '/icons/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName);
                            unlink(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName);
                        }
                    }

                    $pictures = $form->save();

                    //XXX Miniaturki
                    if ($this->makeThumbnails($pictures, $file['file'])) {
                        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));
                        if ($request->hasParameter('_save_and_add')) {
                            $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                            $this->redirect('@icon_new');
                        }
                        else {
                            $this->getUser()->setFlash('notice', $notice);
                            $this->redirect(array('sf_route' => 'icon_edit', 'sf_subject' => $pictures));
                        }
                    }
                    else {
                        $this->getUser()->setFlash('error', 'Nie można dodać obrazka');
                        $this->redirect(array('sf_route' => 'icon_edit', 'sf_subject' => $pictures));
                    }

                }
                else {
                    $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
                }
            }
        }
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $ids = $request->getParameter('ids');

        $objects = Doctrine_Query::create()
                ->from('Icon')
                ->whereIn('id', $ids)
                ->execute();

        foreach ($objects as $key => $object) {
            if ($object->getFile() != '') {
                $fileName = $object->getFile();
                unlink(sfConfig::get('sf_upload_dir') . '/icons/' . $fileName);
                if(substr($fileName, -4) != '.swf') {
                    unlink(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName);
                    unlink(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName);
                    unlink(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName);
                }
            }
        }

        $count = Doctrine_Query::create()
                ->delete()
                ->from('Icon')
                ->whereIn('id', $ids)
                ->execute();

        if ($count >= count($ids)) {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        }
        else {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }

        $this->redirect('@icon');
    }

    public function executeDelete(sfWebRequest $request) {
        $picture = $this->getRoute()->getObject();
        $fileName = $picture->getFile();

        //$request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        /**
         * XXX Kasowanie plików z serwera
         */

        if (
        unlink(sfConfig::get('sf_upload_dir') . '/icons/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName) &&
                unlink(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName)
        ) {
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            $this->redirect('@icon');
        }
        else {
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('error', 'Nie można było usunąć pliku obrazu z serwera. Obrazek został usunięty z bazy danych (jeśli jego plik nie istnieje, to nie powinien się wyświetlać). Sprawdź uprawnienia do katalogu z obrazkami.');
            $this->redirect('@icon');
        }

    }

    protected function makeThumbnails($picture, $file = false) {
        $fileName = $picture->getFile();
        $filePath = sfConfig::get('sf_upload_dir') . '/icons/' . $fileName;
        if (file_exists($filePath)) {

            $settings = stgConfig::getGroup('ICONS');

            //$picSettings = sfConfig::get('mod_user_banners_settings_picture');
            //$thumbSettings = sfConfig::get('mod_user_banners_settings_thumbnail');


            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['icons_thumbnail_min_width'], $settings['icons_thumbnail_min_height'], true, $settings['icons_thumbnail_min_inflate'], $settings['icons_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName);

            // Create the thumbnail
            $thumbnail = new sfThumbnail($settings['icons_thumbnail_max_width'], $settings['icons_thumbnail_max_height'], true, $settings['icons_thumbnail_max_inflate'], $settings['icons_thumbnail_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName);


            //origninal

            if($file) {
                move_uploaded_file($file['tmp_name'], sfConfig::get('sf_upload_dir') . '/icons/original/'.$fileName);
            }
            else {
                $thumbnail = new sfThumbnail(null, null, false, true);
                $thumbnail->loadFile($filePath);
                $thumbnail->save(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName);
            }

            //Picture
            $thumbnail = new sfThumbnail($settings['icons_picture_width'], $settings['icons_picture_height'], true, $settings['icons_picture_inflate'], $settings['icons_picture_compression']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save($filePath);


            if (
            file_exists(sfConfig::get('sf_upload_dir') . '/icons/min/' . $fileName) &&
                    file_exists(sfConfig::get('sf_upload_dir') . '/icons/max/' . $fileName) &&
                    file_exists(sfConfig::get('sf_upload_dir') . '/icons/original/' . $fileName)
            ) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function executeSwitchActive(sfWebRequest $request) {
        $object = $this->getRoute()->getObject();
        $object->switchActive();
        $this->getUser()->setFlash('notice', 'Banner zmieniony pomyślnie');
        $this->redirect('icon');
    }
}
