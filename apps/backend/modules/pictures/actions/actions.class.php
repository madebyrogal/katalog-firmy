<?php

require_once dirname(__FILE__) . '/../lib/picturesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/picturesGeneratorHelper.class.php';

/**
 * pictures actions.
 *
 * @package    stgcms2
 * @subpackage pictures
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class picturesActions extends autoPicturesActions {

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $pic = $request->getFiles($form->getName());
        if (!$form->getObject()->isNew() && ($pic['file']['size'] > 0)) {
            $picture = $request->getParameter('pictures');
            $form->getObject()->removePictures();
        }

        if (!$form->getObject()->isNew() && ($pic['file']['size'] <= 0)) {
            $form->getObject()->setGenerateThumbnails(false);
        }

        $quota = stgConfig::get('system_user_quota');
        $current = T::du(sfConfig::get('sf_upload_dir'));

        if (($pic['file']['size'] + $current) >= $quota) {
            $this->getUser()->setFlash('error', 'Nie masz już miejsca na dodawanie obrazków. Spróbuj dodać mniejszy.');
            $this->redirect('@galleries');
        } else {

            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
                $pictures = $form->save();

                //XXX Miniaturki
                if ($pictures) {
                    $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));

                    if ($request->hasParameter('_save_and_add')) {
                        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                        $this->redirect('@pictures_new');
                    } else {
                        $this->getUser()->setFlash('notice', $notice);
                        $this->redirect('galleries_edit', $form->getObject()->getGalleries());
                    }
                } else {
                    $this->getUser()->setFlash('error', 'Nie można dodać obrazka');
                    $this->redirect(array('sf_route' => 'pictures_edit', 'sf_subject' => $pictures));
                }
            } else {
                $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $picture = $this->getRoute()->getObject();
        $fileName = $picture->getFile();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $this->getRoute()->getObject()->delete();
        
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@pictures');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->pictures = $this->form->getObject();
        if ($request->getParameter('gallery_id') > 0) {
            $this->form->setDefault('gallery_id', $request->getParameter('gallery_id'));
        }
    }

    protected function processLightForm(sfWebRequest $request, sfForm $form, $pic) {
        $notice_type = 'error';
 
        if (!$form->getObject()->isNew() && ($pic['file']['size'] > 0)) {
            $picture = $request->getParameter('pictures');
            $form->getObject()->removePictures();
        }

        if (!$form->getObject()->isNew() && ($pic['file']['size'] <= 0)) {
            $form->getObject()->setGenerateThumbnails(false);
        }

        $quota = stgConfig::get('system_user_quota');
        $current = T::du(sfConfig::get('sf_upload_dir'));

        
        if (($pic['file']['size'] + $current) >= $quota) {
            return array( 'error' => 'Nie masz już miejsca na dodawanie obrazków. Spróbuj dodać mniejszy.');
        } else {
            
            $getParameters['gallery_id'] = $request->getParameter('parent_id');
            $getParameters['_csrf_token'] = $this->form->getCSRFToken(); //$request->getParameter('csrf_token');
            
            $form->bind($getParameters, $pic);
            if ($form->isValid()) {
                $pictures = $form->save();

                //XXX Miniaturki
                if ($pictures) {
                    $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));
                    
                    return array( 'success' => true, 'id' => $pictures->getPrimaryKey());
                    
                } else {
                    return array( 'error' => 'Nie można dodać obrazka');
                }
            } else {      
                return array( 'error' => 'Nie udało się dodać obrazka', 'msg' => $form->getErrorSchema());
            }
        }
    }

    public function executeAjaxUpload(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {

            $uploader = new stgFileUploader();
            $picture = $uploader->handleUpload();
            
            $form = $this->configuration->getForm();
            $this->pictures = $form->getObject();
            $this->form = new lightPicturesForm($this->pictures);
            
            $result = $this->processLightForm($request, $this->form, $picture);

            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

            return sfView::HEADER_ONLY;
        }
    }
    
    public function executeGenerateBackImage(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
            $this->picture = Doctrine::getTable('Pictures')->find($request->getParameter('picture_id'));
        }
    }

}
