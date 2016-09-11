<?php

require_once dirname(__FILE__) . '/../lib/galleriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/galleriesGeneratorHelper.class.php';

/**
 * galleries actions.
 *
 * @package    stgcms2
 * @subpackage galleries
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class galleriesActions extends autoGalleriesActions {

    public function executeDeletePicture(sfWebRequest $request) {
        $separator = ',';
        $referer = $request->getReferer();
        $ids = explode($separator, $request->getParameter('picture_id'));

        $galleryId = Doctrine::getTable('Pictures')->findOneByPictureId($ids[0])->getGalleryId();
        $gallery = Doctrine::getTable('Galleries')->findOneByGalleryId($galleryId);
        
        if (Doctrine::getTable('Pictures')->deleteByIds($ids)) {
            if (!$request->isXmlHttpRequest())
                $this->getUser()->setFlash('notice', 'Wybrane obrazki zostały usunięte');
        }
        else {
            if (!$request->isXmlHttpRequest())
                $this->getUser()->setFlash('error', 'Nie udało się usunąć wybranych obrazków');
        }
        if (!$request->isXmlHttpRequest())
            $this->redirect($referer);

        if ($request->isXmlHttpRequest()) {
            
            $response = array(
                'id' => $ids[0],
                'defaultId' => $gallery->getDefaultPicture()->getPrimaryKey()
            );
            
            echo json_encode($response);
            
            return sfView::HEADER_ONLY;
        }
    }

    public function executeListSettings(sfWebRequest $request) {
        $object = $this->getRoute()->getObject();
        $this->redirect('@settings_galleries?gallery_id=' . $object->getPrimaryKey());
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $ids = $request->getParameter('ids');

        $count = Doctrine_Query::create()
                ->from('Galleries')
                ->whereIn('gallery_id', $ids)
                ->execute();

        foreach ($count as $gallery) {
            $gallery->delete();
        }

        if (count($count) >= count($ids)) {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        } else {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }

        $this->redirect('@galleries');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->galleries = $this->getRoute()->getObject();
        $this->galleries->getWithPictures();
        $this->form = $this->configuration->getForm($this->galleries);
    }

    public function executeListAddPicture(sfWebRequest $request) {
        $galleries = $this->getRoute()->getObject();
        $id = $galleries->getGalleryId();
        $this->redirect('@pictures_new?gallery_id=' . $id);
    }

    public function executeSetDefaultPicture(sfWebRequest $request) {
        $picture = $this->getRoute()->getObject();
        $galleries = $picture->Galleries;
        $galleries->setDefaultPicture($picture);
        $galleries->save();

        $this->redirect($request->getReferer());
    }

}
