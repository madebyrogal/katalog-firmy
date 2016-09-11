<?php

require_once dirname(__FILE__) . '/../lib/menusGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/menusGeneratorHelper.class.php';

/**
 * menus actions.
 *
 * @package    stgcms2
 * @subpackage menus
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class menusActions extends autoMenusActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->collections_array = StgTree::getTreeAsCollectionsArray('Menus');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->object = $this->getRoute()->getObject();
    $this->object->getNode()->delete();
    $this->redirect($request->getReferer());
  }
  
  /*
   * Wykonuje update drzewa AJAXem
   */
  public function executeTreeUpdate(sfWebRequest $request)
  {
    StgTree::treeUpdate($request, 'Menus');
  }

  public function executeChangeIsActive(sfWebRequest $request)
  {
    $obj = $this->getRoute()->getObject();
    $obj->setIsActive(! $obj->getIsActive());
    $obj->save();
    $this->getUser()->setFlash('notice', $obj->getIsActive() ? 'Aktywowano element' : 'Ukryto element');
    $this->redirect('@menus');
  }

  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getLevel() > 0)
    {
      $this->menus = $this->getRoute()->getObject();
      $this->form = $this->configuration->getForm($this->menus);
    }
    else
    {
      $this->getUser()->setFlash('error', 'Nie można edytować całego menu');
      $this->redirect('@menus');
    }
  }

//  public function executeUpdate(sfWebRequest $request)
//  {
//
//  }
}
