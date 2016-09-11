<?php

class Lang
{
  private $languages = array();
//  private static $instance;
  private function __construct() {}
  private function __clone(){}

  public static function getInstance()
  {
    return new self();
  }

  public function toArray()
  {
    return $this->languages;
  }

  public function getFirstLanguage()
  {
    return $this->languages[0];
  }

  public function toYaml()
  {
    $return = '';
    $count = count($this->languages);
    if($count == 1)
    {
      $return = $this->languages[0];
    }
    else if($count > 1)
    {
      foreach($this->languages as $key => $language)
      {
        $return .= ($key+1 == $count) ? $language : $language.',';
      }
    }
    return $return;
  }

  // zwraca obiekty Doctrine
  public static function getAllActiveObjects()
  {
    return CultureTable::getInstance()->queryActive()->execute();
  }

  // zwraca np. 'pl'
  public static function getDefaultLanguage()
  {
    return self::getInstance()->getDefault()->getFirstLanguage();
  }

  public function getActive()
  {
    $list = CultureTable::getInstance()->queryActive()->fetchArray();
    foreach($list as $key => $lang)
    {
      $this->languages[] = $lang['language'];
    }
    unset($list);
    return $this;
  }

  public function getAll()
  {
    $list = CultureTable::getInstance()->queryAll()->fetchArray();
    foreach($list as $key => $lang)
    {
      $this->languages[] = $lang['language'];
    }
    unset($list);
    return $this;
  }

  public function getNotDeleted()
  {
    $list = CultureTable::getInstance()->queryNotDeleted()->fetchArray();
    foreach($list as $key => $lang)
    {
      $this->languages[] = $lang['language'];
    }
    unset($list);
    return $this;
  }

  public function getNotDeletedAndNotDefault()
  {
    $list = CultureTable::getInstance()->queryNotDeletedAndNotDefault()->fetchArray();
    foreach($list as $key => $lang)
    {
      $this->languages[] = $lang['language'];
    }
    unset($list);
    return $this;
  }

  public function getActiveAndNotDefault()
  {
    $list = CultureTable::getInstance()->queryActiveAndNotDefault()->fetchArray();
    foreach($list as $key => $lang)
    {
      $this->languages[] = $lang['language'];
    }
    unset($list);
    return $this;
  }

  public function getDefault()
  {
    $object = CultureTable::getInstance()->getDefaultCulture();
    $this->languages = array($object['language']);
    return $this;
  }  

  public function hasAnyLanguages()
  {
    return (CultureTable::getInstance()->getAllActive()->count() > 1) ? true : false;
  }

  public static function checkIsActive($lang) {
//T::pr(CultureTable::getInstance()->queryNotDeleted()->addWhere('culture.language = ?', $lang)->fetchOne()->toArray());
    return (CultureTable::getInstance()->queryActive()
                                       ->addWhere('culture.language = ?', $lang)
                                       ->fetchOne()
           ) ? true : false;
  }

  public static function checkIsNotDeleted($lang) {
//T::pr(CultureTable::getInstance()->queryNotDeleted()->addWhere('culture.language = ?', $lang)->fetchOne()->toArray());
    return (CultureTable::getInstance()->queryNotDeleted()
                                       ->addWhere('culture.language = ?', $lang)
                                       ->fetchOne()
           ) ? true : false;
  }

  public static function getThisLangOrDefaultIfThisNotActive($lang) {
    return self::checkIsActive($lang) ? $lang : self::getDefaultLanguage();
  }

//WIDGETS
  static public function getDefaultWidget()
  {
    echo self::getInstance()->getDefault()->toYaml();
  }

  static public function getNotDeletedAndNotDefaultWidget()
  {
    if (self::getInstance()->hasAnyLanguages() == true)
    {
      echo '"Tłumaczenia": [' . self::getInstance()->getNotDeletedAndNotDefault()->toYaml() . ']';
    }
  }

  static public function getActiveAndNotDefaultWidget()
  {
    if (self::getInstance()->hasAnyLanguages() == true)
    {
      echo '"Tłumaczenia": [' . self::getInstance()->getActiveAndNotDefault()->toYaml() . ']';
    }
  }
//WIDGETS


  /**
   * string $change_string będzie zamieniony na symbol języka dla każdego elementu tablicy $input_array
   */
  static public function createLangStrings($change_string, $input_array, $add_no_lang_version = false) {
    $output_array = array();
    foreach ($input_array as $input_array_item) {
      foreach (Lang::getInstance()->getAll()->toArray() as $lang) {
        $output_array[] = str_replace('LANG', $lang, $input_array_item);
      }
      if ($add_no_lang_version) {
        $output_array[] = str_replace('LANG_', '', $input_array_item);
      }
    }
    return $output_array;
  }

  /**
   * Tworzy i zapisuje rekordy tłumaczeń, których obiekt nie ma, a które powinny być
   */
  static public function createUnexistingTranslations($object) {
    // Klasa obiektu
    $objectClass = get_class($object);
    // Klasa tłumaczenia obiektu
    $translationClass = $objectClass.'Translation';
    // Tablica tłumaczeń obiektu
    $translationTable = Doctrine::getTable($translationClass);
    // Identyfikator tłumaczenia
    $translationPrimaryKeysNames = $translationTable->getIdentifierColumnNames();
    $objectForeignKeyName = $translationPrimaryKeysNames[0];

    // Kolekcja tłumaczeń
    $translations = $translationTable
                      ->createQuery()
                      ->addWhere($objectForeignKeyName.' = ?', $object->getPrimaryKey())
                      ->execute()
                      ;

    // Języki, dla których istnieją tłumaczenia
    $existingTranslationsLangsArray = array_keys($translations->toArray());
    // Języki, dla których nie ma tłumaczeń
    $unexistingTranslationsLangsArray = array_diff(self::getInstance()->getActive()->toArray(), $existingTranslationsLangsArray);

    // Tworzenie tłumaczeń
    foreach ($unexistingTranslationsLangsArray as $lang) {
      $translationObject = new $translationClass();
      $translationObject->set('lang', $lang);
      $translationObject->set($objectForeignKeyName, $object->getPrimaryKey());
      // TODO: (?) tu można dodać zapełnianie nowej wersji językowej na podstawie istniejącej wersji
      $translationObject->save();
    }
  }

}
?>