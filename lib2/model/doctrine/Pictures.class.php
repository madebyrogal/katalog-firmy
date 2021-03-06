<?php

/**
 * Pictures
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    stgcms2
 * @subpackage model
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Pictures extends BasePictures
{
  /**
   * Determines if thumbnails are generated. Defaults to true (generate :))
   *
   * If you don't want to generate thumbnails:
   * 1. $picture->setGenerateThumbnails(false);
   * 2. $picture->save();
   * @var Boolean
   */
  private $generateThumbnails = true;

  public function setGenerateThumbnails($generate)
  {
    $this->generateThumbnails = (bool)$generate;
  }

  public static function getThumbnailTypes()
  {
    $default_thumbnailtypes = array('min','mid','max','homepage'); //defaultowo, nie zmieniać tego, żeby się nie posypały starsze serwisy - jeśli chcesz coś zmienić to przez superconfig

    $superconfig_thumbnailtypes = stgConfig::get('pictures_thumbnail_types');
    if ($superconfig_thumbnailtypes) {
      $superconfig_thumbnailtypes = explode(',', $superconfig_thumbnailtypes);
    }
    
    return $superconfig_thumbnailtypes ? $superconfig_thumbnailtypes : $default_thumbnailtypes;
  }
  
  public function getWithGalleries()
    {
        return Doctrine::getTable('Pictures')->getWithGalleries();
    }

    /**
     * SAVES TRANSLATIONS
     */
    public function initalizeTranslations() {
      foreach(Lang::getInstance()->getAll()->toArray() as $lang) { //foreach language
        $this->Translation[$lang]; //nic z tym nie robię - wystarczy, że to się zainicjalizuje w obiekcie
      }
    }

    public function save(Doctrine_Connection $conn = null)
    {
      $this->initalizeTranslations(); // żeby zapisały się wersje językowe

        if($this->getFile() == '')
        {
            return true;
        }

        if($this->generateThumbnails == true)
        {
          $this->makeThumbnails();
        }
        $return = parent::save($conn);

      // Ustawianie Galerii domyslnego Picture
      DoctrineModels::setDefaultRelationIfNull($this, 'Galleries', 'DefaultPicture');
//        if ($gallery = $this->Galleries) {
//          if ($gallery->getPicturesCount() == 1) { //to jest pierwszy obiekt w relacji
//            $gallery->setDefaultPicture($this);
//            $gallery->save();
//          }
//        }

        T::cc('frontend');
        return $return;
    }

    public function delete(Doctrine_Connection $conn = null)
    {
      if (count($galleryWhereDefault = $this->GalleryWhereDefault)) {
        $galleryWhereDefault->setDefaultPictureAnyExcept($this);
      }

      T::cc('frontend');
      $this->removePictures();
      T::cc('frontend');
      return parent::delete($conn);   //deletes object
    }

    //deletes picture files
    public function removePictures()
    {
      $fileName = $this->getFile();
      $is_ok = true;
      $is_ok = (unlink(sfConfig::get('sf_upload_dir').'/pictures/'.$fileName) == true) ? $is_ok : false;
      foreach (self::getThumbnailTypes() as $thumbType)
      {
        $is_ok = (unlink(sfConfig::get('sf_upload_dir').'/thumbnails/'.$thumbType.'/'.$fileName) == true) ? $is_ok : false;
      }
      return (bool)$is_ok;
    }

    public function makeThumbnails()
    {
        $fileName = $this->getFile();
        $filePath = sfConfig::get('sf_upload_dir').'/pictures/'.$fileName;
        if(file_exists($filePath))
        {
          $is_ok = true;
          $thumbSettings = array();

          $config = SuperConfig::getByScope('PICTURES');

          // tworzenie katalogu 'thumbnails'
          $thumbnails_directory = sfConfig::get('sf_upload_dir').'/thumbnails';
          if (!is_readable($thumbnails_directory)) {
            mkdir($thumbnails_directory, 0777, true);
            chmod($thumbnails_directory, 0777);
          }

          foreach (self::getThumbnailTypes() as $thumbType)
          {
            $thumbSettings[$thumbType.'_width']   =   $config['pictures_settings_thumbnail_'.$thumbType.'_width'] ? $config['pictures_settings_thumbnail_'.$thumbType.'_width'] : null;
            $thumbSettings[$thumbType.'_height']   =   $config['pictures_settings_thumbnail_'.$thumbType.'_height'] ? $config['pictures_settings_thumbnail_'.$thumbType.'_height'] : null;
            $thumbSettings[$thumbType.'_inflate']   =   $config['pictures_settings_thumbnail_'.$thumbType.'_inflate'] ? $config['pictures_settings_thumbnail_'.$thumbType.'_inflate'] : null;
            $thumbSettings[$thumbType.'_scale']   =   isset($config['pictures_settings_thumbnail_'.$thumbType.'_scale']) ? $config['pictures_settings_thumbnail_'.$thumbType.'_scale'] : null;

            // tworzenie katalogu z miniaturami danego rozmiaru
            $directory = $thumbnails_directory.'/'.$thumbType;
            if (!is_readable($directory)) {
              mkdir($directory, 0777, true);
              chmod($directory, 0777);
            }

            $thumbnail = new sfThumbnail($thumbSettings[$thumbType.'_width'],$thumbSettings[$thumbType.'_height'],$thumbSettings[$thumbType.'_scale'],$thumbSettings[$thumbType.'_inflate']);
            $thumbnail->loadFile($filePath);
            $thumbnail->save($directory.'/'.$fileName);
            $is_ok = (file_exists($directory.'/'.$fileName)) ? $is_ok : false;
          }
//            //Generates watermark over picture
//            $img = new sfImage($filePath);
//            $img->overlay(new sfImage(sfConfig::get('sf_web_dir').'/themes/kriwcrm/img/logo.png'), 'top-left'); // or you can use coords array($x,$y)
//            $img->save();
          return (bool)$is_ok;
        }
        else
        {
            return false;
        }
    }

    public function isDefault() {
//      return ($this->getGalleryIdWhereIsDefault()) ? true : false;
      return ($this->Galleries->getDefaultPictureId() == $this->getPrimaryKey()) ? true : false;
    }

    public function getIsDefault() { //potrzebne są obie metody: isDefault i getIsDefault
      return $this->isDefault();
    }

    public function setIsDefault($new_is_default) {
      // TA METODA MUSI BYĆ PUSTA ZE WZGLĘDU NA SYNCHRONIZACJĘ! - zamiast tego  domyślny obrazek jest ustawiany w ErpZdjecie ---> synchronize()
    }

    public function getGalleryIdWhereIsDefault() {
      return $this->GalleryWhereDefault->getPrimaryKey();
    }

    public function getUrl($picture_type = null) {
      $url = '/uploads/';
      $url .= ($picture_type) ? 'thumbnails/' . $picture_type . '/' : 'pictures/';
      $url .= $this->getFile();
      return $url;
    }

//    public function getFileByUrl() {
//      $r =  $this->getFile();
//      $r = str_replace('imported_', '', $r);
//
//      $settings = SuperConfig::getAll(); //nie wiem czemu w taskach (?) nie działa wyciąganie pojedynczych ustawień z SuperConfiga
//      $settings = $settings['all']['super_config'];
//      $prefix = $settings['subiekt_pictures_path_is_absolute'] ? '' : $settings['sf_upload_dir'].'/';
//      $r = $prefix.$settings['subiekt_pictures_path'].'/'.$r;
//
//      return $r;
//    }

    public function getFileByUrl() {
      $r =  $this->getFile();
      $r = str_replace('imported_', '', $r);

      $settings = SuperConfig::getAll(); //nie wiem czemu w taskach (?) nie działa wyciąganie pojedynczych ustawień z SuperConfiga
      $settings = $settings['all']['super_config'];
//      $prefix = $settings['subiekt_pictures_path_is_absolute'] ? '' : $settings['sf_upload_dir'].'/';
      $prefix = ($settings['subiekt_pictures_path_is_absolute'] == 'on') ? '' : sfConfig::get('sf_upload_dir').'/';
      $r = $prefix.$settings['subiekt_pictures_path'].'/'.$r;

      return $r;
    }

    public function setFileByUrl($url) {
      if (!$this->getFile()) { //zakładam, że w Erp nie może się zmienić plik przypisany do tego samego ErpZdjecie
        $thumbnail = new sfThumbnail();
        $thumbnail->loadFile($url);
//        $file_name = md5(uniqid(rand(), true)).'.jpg'; //TODO: co, jeśli nie jpg + co, jeśli trafimy w nieunikalną nazwę
        $file_name = 'imported_'.basename($url);

        $thumbnail->save(sfConfig::get('sf_upload_dir').'/pictures/'.$file_name);

        $new_path = sfConfig::get('sf_upload_dir').'/pictures/'.$file_name;
        $is_ok = file_exists($new_path);

        if ($is_ok) {
          $this->setFile($file_name);
          $this->makeThumbnails();
        }
      }
    }

//    public function setFileByUrl($url) {
//      if (!$this->getFile()) { //zakładam, że w Erp nie może się zmienić plik przypisany do tego samego ErpZdjecie
//        $file_name = 'imported_'.basename($url);
//        $new_path = sfConfig::get('sf_upload_dir').'/pictures/'.$file_name;
//
//        if (SuperConfig::getSettingBooleanFromDB('subiekt_pictures_path_is_absolute')) { // zdjecia sa na innym serwerze
//          $thumbnail = new sfThumbnail();
//          $thumbnail->loadFile($url);
//  //        $file_name = md5(uniqid(rand(), true)).'.jpg'; //TODO: co, jeśli nie jpg + co, jeśli trafimy w nieunikalną nazwę
//
//          $thumbnail->save(sfConfig::get('sf_upload_dir').'/pictures/'.$file_name);
//        }
//        else { // zdjecia sa na tym samym serwerze
//          $old_path = $url;
//          copy($old_path, $new_path);
//        }
//
//        $is_ok = file_exists($new_path);
//
//        if ($is_ok) {
//          $this->setFile($file_name);
//          $this->makeThumbnails();
//        }
//      }
//    }

}
