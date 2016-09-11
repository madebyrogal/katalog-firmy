<?php

/**
 * UserBanners
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    stgcms2
 * @subpackage model
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class UserBanners extends BaseUserBanners
{
  public static function getSubdirectories()
  {
    return array('original', 'min', 'max');
  }

  public static function getDir()
  {
    return sfConfig::get('sf_upload_dir').'/user_banners';
  }

  public function save(Doctrine_Connection $conn = null)
  {
    T::cc('frontend');
    return parent::save($conn);
  }

  public function delete(Doctrine_Connection $conn = null)
  {
    T::cc('frontend');
    return parent::delete($conn);
  }

  static public function getAllActive()
  {
    $q = Doctrine_Query::create()->from('UserBanners')->where('is_active = ?', true)->execute();
    return $q;
  }

  public function switchActive()
  {
    if ($this->getIsActive())
    {
      $this->setIsActive(false);
      $this->save();
    }
    else
    {
      $activeObjects = UserBanners::getAllActive();
      foreach ($activeObjects as $k => $o)
      {
        $o->setIsActive(false);
        $o->save();
      }
      $this->setIsActive(true);
      $this->save();
    }
  }

  static public function getOneByPk($pk)
  {
    return UserBannersTable::getOneByPkQuery($pk)->fetchOne();
  }

  static public function getOneByFile($file)
  {
    return UserBannersTable::getOneByFileQuery($file)->fetchOne();
  }

}