<?php

require_once dirname(__FILE__) . '/../lib/art_categoriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/art_categoriesGeneratorHelper.class.php';

class art_categoriesActions extends autoArt_categoriesActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->collections_array = StgTree::getTreeAsCollectionsArray('ArtCategories', array('tree_key' => ArtCategories::getArtCategoriesTreeKeys()));
  }

  public function executeNew(sfWebRequest $request)
  {
    parent::executeNew($request);
    $this->form->createWidgetParentId(ArtCategories::getArtCategoriesTreeKeys());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->form->createWidgetParentId(ArtCategories::getArtCategoriesTreeKeys());
    $this->art_categories = $this->form->getObject();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeDelete(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getIsDeletable()) {
      $this->object = $this->getRoute()->getObject();
      $this->object->getNode()->delete();
      $this->redirect($request->getReferer());
    }
    else {
      $this->redirect($request->getReferer());
    }
  }

  public function executeTreeUpdate(sfWebRequest $request)
  {
    StgTree::treeUpdate($request, 'ArtCategories'); //Wykonuje update drzewa AJAXem
  }

  public function executeListSettings(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $this->redirect('@settings_artcategories?artcategory_id='.$object->getPrimaryKey());
  }

  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getIsEditable()) {
      parent::executeEdit($request);
    }
    else {
      $this->redirect($request->getReferer());
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getIsEditable()) {
      parent::executeUpdate($request);
    }
    else {
      $this->redirect($request->getReferer());
    }
  }
}
