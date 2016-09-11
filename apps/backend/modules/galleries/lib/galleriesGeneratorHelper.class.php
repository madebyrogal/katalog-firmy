<?php

/**
 * galleries module helper.
 *
 * @package    stgcms2
 * @subpackage galleries
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class galleriesGeneratorHelper extends BaseGalleriesGeneratorHelper
{
  public function linkToDelete($object, $params)
  {
    return $object->getIsDeletable() ? parent::linkToDelete($object, $params) : '';
  }
  
  public function linkToEdit($object, $params)
  {
//    return $object->getIsEditable() ? parent::linkToEdit($object, $params) : '';

    $links = parent::linkToEdit($object, $params)
//      .'<li class="sf_admin_action_settings"><a href="/backend.php/galleries/'.$object->getPrimaryKey().'/ListSettings">Ustawienia</a></li>'
      .'<li class="sf_admin_action_addpicture"><a href="/backend.php/galleries/'.$object->getPrimaryKey().'/ListAddPicture">Dodaj obrazek</a></li>'
      ;

    return $object->getIsEditable() ? $links : '';
  }

//  public function linkToAddPicture($object, $params)
//  {
//    return $object->getIsEditable() ? parent::linkToAddPicture($object, $params) : '';
//  }

}
