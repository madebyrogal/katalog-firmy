<?php

require_once dirname(__FILE__).'/../lib/categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoryGeneratorHelper.class.php';

/**
 * category actions.
 *
 * @package    sell4
 * @subpackage category
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends autoCategoryActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->collections_array = StgTree::getTreeAsCollectionsArray('Category');
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
    StgTree::treeUpdate($request, 'Category');
  }
}
