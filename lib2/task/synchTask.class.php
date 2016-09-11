<?php

class synchTask extends sfBaseTask
{
  // Możliwe warianty synchronizacji (bez wariantu = synchronizuj wszystko)
  private $variant_names = array('product', 'quantity', 'order', 'user', 'picture');

  // Inne opcje
  private $option_names = array('force', // Wymuś wykonanie synchronizacji niezależnie od tego, czy jest potrzebna
                                'show', // Czy pokazywać komunikaty?
                                );

  // Która z erpSynchronizations (wystarczy 1 z tabeli) powoduje konieczność przeprowadzenia danego wariantu.
  private $if_changes_conditions = array(
      //'WARIANT' => array(RODZAJE erpSynchronizations),
//      'product' => array('Produkty', /*OR*/ 'Zdjecia'),
      'product' => array('Produkty'),
      'picture' => array('Zdjecia'),
      'quantity' => array('Stany'),
      'order' => array('Zamówienia'),
      'user' => array('Kontrahenci'),
  );

  protected $show = 0;

  /**
   * Konfiguracja
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    // Dodawanie opcji na podstawie $this->option_names
    foreach ($this->option_names as $option) {
      $this->addOption($option, null, sfCommandOption::PARAMETER_NONE);
    }

    // Dodawanie opcji na podstawie $this->variant_names
    foreach ($this->variant_names as $option) {
      $this->addOption($option, null, sfCommandOption::PARAMETER_NONE);
    }

    $this->namespace        = 'stg';
    $this->name             = 'synch';
    $this->briefDescription = 'Execute synchronization SUBIECT <--> SELL';
    $this->detailedDescription = <<<EOF
Task [synch|INFO] przeprowadza synchronizację z tabel łączących do sklepu.
Wywołanie:

  [php symfony synch|INFO] - synchronizacja wszystkiego
  [php symfony synch --product|INFO] - synchronizacja produktów
  [php symfony synch --quantity|INFO] - synchronizacja stanów magazynowych
  [php symfony synch --product --user|INFO] - synchronizacja produktów i kontrahentów
  itd.
EOF;
   $this->detailedDescription .= ' (dostępne warianty: '.implode(', ', $this->variant_names).')';
  }

  /**
   * Wywołanie taska
   */
  protected function execute($arguments = array(), $options = array())
  {
    $time_start = time();

    // Przygotowanie
    $this->show = $options['show'];
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    if (!SuperConfig::getSettingBooleanFromDB('subiekt_enabled', false)) {
      echo 'Integracja z Subiektem jest wyłączona.'."\n";
      exit();
    }

    // Przerwij jeśli nie wybrano żadnych wariantów
    if (!count($variants = $this->getVariants($options))) {
      $this->echoMessage(Color::bool(true, 'Synchronizacja nie jest konieczna'), false);
      $this->log($time_start, 'nothing', true);
      return null;
    }
    
    // Dla każdego wariantu synchronizacji
    foreach ($variants as $variant) {
      $time_start = time();
      
      // Uruchom dany wariant
      $method = 'executeVariant'.sfInflector::camelize($variant);
      $success = $this->$method($variants, $variant);

      // Komunikaty i logi
      if ($success) {
        $this->setVariantIsNotNeeded($variant);
      }
      $this->echoMessage(Color::bool($success, $variant.': Synchronizacja zakończona pomyślnie.', $variant.': Wystąpiły błędy w synchronizacji.'), false);
      $this->log($time_start, $variant, $success);
    }
  }

  /********* WARIANTY SYNCHRONIZACJI *************************************************************************************************/

  /**
   * Wariant 'product'
   */
  protected function executeVariantProduct($variants, $variant)
  {
    // Wykonaj następujące synchronizacje:
    return $this->doSynch(array(
      'synchGroups',
      'synchProducers',
      'synchProductFlags',
      'synchProductCustomFields',
      'synchTariffs',
      'synchProducts',
      'synchDiscounts',
      'synchDiscountProducts',
      'synchDiscountProfiles', //NIE WIEM CZY BEZPIECZNIE JEST TO ODDZIELAĆ OD synchDiscounts
      'synchProductPrices',
      'synchProduct2ProductFlags',
      'synchProductCustomFieldValues',
      'synchProductCategoryRules',
    ));
  }

  /**
   * Wariant 'picture'
   */
  protected function executeVariantPicture($variants, $variant)
  {
    // Wykonaj następujące synchronizacje:
    return $this->doSynch(array(
      'synchProductPictures'
    ));
  }

  /**
   * Wariant 'order'
   */
  protected function executeVariantOrder($variants, $variant)
  {
    // Wykonaj następujące synchronizacje:
    return $this->doSynch(array(
      'synchOrders',
      'synchOrderCustomFields',
    ));
  }

  /**
   * Wariant 'user'
   */
  protected function executeVariantUser($variants, $variant)
  {
    // Wykonaj następujące synchronizacje:
    return $this->doSynch(array(
      'synchProfileCustomFields',
    ));
  }

  /**
   * Wariant 'quantity'
   */
  protected function executeVariantQuantity($variants, $variant)
  {
    //Jeśli była już synchronizacja produktów, to nie trzeba już robić synchronizacji stanów
    if (in_array('product', $variants)) { 
      return true;
    }
    
    // Wykonaj następujące synchronizacje:
    return $this->doSynch(array(
      'synchProductQuantities'
    ));
  }

  /******** SYNCHRONIZACJA POSZCZEGÓLNYCH MODELI *************************************************************************************************/

  /**
   * Synchronizacja grup produktów
   */
  protected function synchGroups() {
    $this->echoMessage('Synchronizacja grup produktów');
    return $this->synchAndClean('ErpSlownikGrupa', 'ProductGroup', 'erp_slg_id');
  }

  /**
   * Synchronizacja producentów
   */
  protected function synchProducers() {
    $this->echoMessage('Synchronizacja producentów');
    return $this->synchAndClean('ErpProducent', 'Producer', 'erp_pc_id');
  }

  /**
   * Synchronizacja słownika flag produktów
   */
  protected function synchProductFlags() {
    $this->echoMessage('Synchronizacja słownika flag produktów');
    return $this->synchAndClean('ErpSlownikCechaProduktu', 'ProductFlag', 'erp_chp_id');
  }

  /**
   * Synchronizacja słownika pól własnych produktów
   */
  protected function synchProductCustomFields() {
    $this->echoMessage('Synchronizacja słownika pól własnych produktów');
    return $this->synchAndClean('ErpSlownikPolewlasneproduktu', 'ProductCustomField', 'erp_spr_id');
  }

  /**
   * Synchronizacja słownika pól własnych kontrahentów
   */
  protected function synchProfileCustomFields() {
    $this->echoMessage('Synchronizacja słownika pól własnych kontrahentów');
    return $this->synchAndClean('ErpSlownikPolewlasnekontrahenta', 'ProfileCustomField', 'erp_spk_id');
  }

  /**
   * Synchronizacja taryf
   */
  protected function synchTariffs() {
    $this->echoMessage('Synchronizacja taryf');
    return $this->synchAndClean('ErpSlownikCena', 'Tariff', 'erp_cn_id');
  }

  /**
   * Synchronizacja produktów
   */
  protected function synchProducts() {
    $this->echoMessage('Synchronizacja produktów');
    return $this->synchAndClean('ErpProdukt', 'Product', 'erp_pr_id');
  }

  /**
   * Synchronizacja pól własnych zamówień
   */
  protected function synchOrderCustomFields() {
    $this->echoMessage('Synchronizacja pól własnych zamówień');
    return $this->synchAndClean('ErpZamowieniePolewlasne', 'OrderCustomField', 'erp_zpw_id');
  }

  /**
   * Synchronizacja promocji
   */
  protected function synchDiscounts() {
    $this->echoMessage('Synchronizacja promocji');
    return $this->synchAndClean('ErpPromocja', 'Discount', 'erp_pm_id');
  }
  
  /**
   * Synchronizacja stanów magazynowych produktów
   */
  protected function synchProductQuantities() {
    $this->echoMessage('Synchronizacja stanów magazynowych produktów');
    return $this->synchAndClean('ErpProduktStan', null, null); //bez czyszczenia
  }

  /**
   * Synchronizacja zamówień
   */
  protected function synchOrders() {
    $this->echoMessage('Synchronizacja zamówień');
    return $this->synchAndClean('ErpZamowienie', null, null); //bez czyszczenia
  }

  /**
   * Synchronizacja cen produktów
   */
  protected function synchProductPrices() {
    $this->echoMessage('Synchronizacja cen produktów');
    return $this->synchAndCleanRef('ErpProduktCena', 'ProductPrice', 'product_id', 'tariff_id'); //referencyjna
  }

  /**
   * Synchronizacja przypisań flag produktów
   */
  protected function synchProduct2ProductFlags() {
    $this->echoMessage('Synchronizacja przypisań flag produktów');
    return $this->synchAndCleanRef('ErpProduktCecha', 'Product2ProductFlag', 'product_id', 'product_flag_id'); //referencyjna
  }

  /**
   * Synchronizacja przypisań pól własnych produktów
   */
  protected function synchProductCustomFieldValues() {
    $this->echoMessage('Synchronizacja przypisań pól własnych produktów');
    return $this->synchAndCleanRef('ErpProduktPolewlasne', 'ProductCustomFieldValue', 'product_id', 'product_custom_field_id'); //referencyjna
  }

  /**
   * Synchronizacja przypisań promocji do produktów
   */
  protected function synchDiscountProducts() {
    $this->echoMessage('Synchronizacja przypisań promocji do produktów');
    return $this->synchAndCleanRef('ErpPromocjaProdukt', 'Discount2Product', 'product_id', 'discount_id'); //referencyjna
  }


  /**
   * Synchronizacja przypisań promocji do kontrahentów
   */
  protected function synchDiscountProfiles() {
    $this->echoMessage('Synchronizacja przypisań promocji do kontrahentów');
    return $this->synchAndCleanRef('ErpPromocjaKontrahent', 'Discount2Profile', 'profile_id', 'discount_id'); //referencyjna
  }

  /**
   * Synchronizacja obrazków produktów
   */
  protected function synchProductPictures() {
    $this->echoMessage('Synchronizacja obrazków produktów');

    $success = true;

    $erpPictures = Doctrine::getTable('ErpZdjecie')->findAll();
    $pictures = new Doctrine_Collection('Pictures');
    foreach ($erpPictures as $erpPicture) {
      $pictures[] = $erpPicture->synchronize();
    }
    // usuwanie zdjęć produktów, których nie ma już w Erp
    Doctrine::getTable('Pictures')->deleteAllProductOthers($pictures);

    return $success;
  }

  /**
   * Synchronizacja produktów
   */
  protected function synchProductCategoryRules() {
    $this->echoMessage('Synchronizacja przypisań produktów do kategorii wg reguł');

    $success = true;

    $products = Doctrine::getTable('Product')->findByIsForProductCategoryRulesSynchronisation(true);
    foreach ($products as $product) {
      $product->applyProductCategoryRules();
      $product->setIsForProductCategoryRulesSynchronisation(false);
      $product->save();
    }

    return $success;
  }


  /******** GŁÓWNE FUNKCJE SYNCHRONIZACYJNE *************************************************************************************************/

  /**
   * Główna funkcja synchronizacyjna - dla normalnych modeli niereferencyjnych
   */
  protected function synchAndClean($erp_model_name, $model_name = null, $field_name_of_erp_id_in_model = null)
  {
    $success = true; //TODO na razie zawsze true

    //Synchronizacja
    $erpRecords = Doctrine::getTable($erp_model_name)->findAll();
    foreach ($erpRecords as $erpRecord) {
      $erpRecord->synchronize();
    }

    //Usuwanie rekordów, których nie ma już w Erp (jeśli  $model_name  (lub $field_name_of_erp_id_in_model) == null to nie usuwaj
    if ($model_name && $field_name_of_erp_id_in_model) {
      DoctrineModels::deleteAllNotInArray($model_name, $field_name_of_erp_id_in_model, $erpRecords->getPrimaryKeys());
    }

    return $success;
  }

  /**
   * Główna funkcja synchronizacyjna - dla modeli referencyjnych
   */
  protected function synchAndCleanRef($erp_model_name, $model_name, $id_1, $id_2)
  {
    $success = true; //TODO na razie zawsze true

    //Synchronizacja
    $erpRecords = Doctrine::getTable($erp_model_name)->findAll();
    $modelCollection = new Doctrine_Collection($model_name);
    foreach ($erpRecords as $erpRecord) {
      $modelCollection[] = $erpRecord->synchronize();
    }
    // usuwanie cech, których nie ma już w Erp
    DoctrineModels::deleteAllOthers($model_name, $modelCollection, $id_1, $id_2);

    return $success;
  }

  /******** FUNCKJE DO OBSŁUGI WARIANTÓW *************************************************************************************************/

  /**
   * Zwraca tablicę wariantów do wykonania
   */
  protected function getVariants($options)
  {
    // Weź warianty z opcji taska
    $possible_variants = array();
    foreach ($this->variant_names as $variant_name) {
      if ($options[$variant_name]) {
        $possible_variants[] = $variant_name;
      }
    }

    // Jeśli nie został wybrany żaden wariant, to zwraca wszystkie możliwe warianty
    $possible_variants = count($possible_variants) ? $possible_variants : $this->variant_names;

    // Sprawdź czy trzeba wykonywać dany wariant
    $variants = array();
    foreach ($possible_variants as $possible_variant_name) {
      if ($this->checkVariantIsNeeded($possible_variant_name, $options)) {
        $variants[] = $possible_variant_name;
      }
    }

    return $variants;
  }

  protected function checkVariantIsNeeded($variant_name, $options)
  {
    if ($options['force']) {
      return true; //TODO
    }

    $needed_erp_synchronizations = $this->if_changes_conditions[$variant_name];

    $needed = false;
    foreach ($needed_erp_synchronizations as $needed_erp_synchronization) {
      $needed = $needed + Doctrine::getTable('ErpSynchronizations')->isSynchronizationNeeded($needed_erp_synchronization);
    }

    return $needed;
  }

  protected function setVariantIsNotNeeded($variant_name)
  {
    $needed_erp_synchronizations = $this->if_changes_conditions[$variant_name];

    foreach ($needed_erp_synchronizations as $needed_erp_synchronization) {
      Doctrine::getTable('ErpSynchronizations')->setSynchronizationIsNotNeeded($needed_erp_synchronization);
    }
  }

  /******** FUNCKJE POMOCNICZE *************************************************************************************************/

  /**
   * Wyświetla komunikat na ekranie
   */
  protected function echoMessage($msg, $add_new_line = true)
  {
    if ($this->show) {
      if ($add_new_line) {
        $msg = $msg."\n";
      }
      echo $msg;
    }
  }

  /**
   * Logowanie sukcesu synchronizacji
   */
  public function log($time_start, $type, $success)
  {
    $time_end = time();
    $duration = $time_end - $time_start;

    $memoryPeak = memory_get_peak_usage(true);

    $log = new Synchronization();
    $log->setType($type);
    $log->setSuccess($success);
    $log->setTimeStart(date("Y-m-d H:i:s", $time_start));
    $log->setTimeEnd(date("Y-m-d H:i:s", $time_end));
    $log->setDuration($duration);
    $log->setMemoryPeak($memoryPeak);
    $log->save();
  }

  /**
   * Odpala funkcje podane w tablicy $methodsNames i zwraca iloczyn wyników (czyli true <=> wszystkie metody zwrócą true).
   */
  protected function doSynch($methodsNames)
  {
    $success = true;
    foreach ($methodsNames as $methodName) {
      $method_success = $this->$methodName();
      $this->echoMessage(Color::bool($method_success), false);
      $success = $success * $method_success;

    }
    return $success;
  }

}
