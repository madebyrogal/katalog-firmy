<?php
class stgHelp
{
  private $data = array();
  private static $instance;

  private function __construct()
  {
    //$this->data = sfConfig::get('app_stg_help');  //grap help settings
    $yaml = new sfYamlParser();
     
    $this->data = sfYaml::load(sfConfig::get('sf_app_config_dir') . '/help.yml');
    $this->classifyHelps(); //classify help messages
  }

  /**
   * Adds DIV with CLASS attrinute to help messages
   *
   * Parameters to set in app.yml
   * class - the class to be set
   */
  protected function classifyHelps()
  {
    foreach($this->data['forms'] as $form => $fields)
    {
      foreach($fields as $field => $value)
      {
        $this->data['forms'][$form][$field] = '<div class="help_tick"">&nbsp;</div><div class="'.$this->data['class'].'">'.$value.'</div>';
      }
    }
  }

  // Blokujemy domyślny konstruktor publiczny
  private function __clone() {}

  //Uniemożliwia utworzenie kopii obiektu
  public static function getInstance()
  {
    if (self::$instance === null)
    {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * This method returns field help messages array for provided form
   *
   * You can set this array in sfWidgetSchema's setHelps method
   * @example $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps(new EditAdminForm($admin)));
   * @param sfForm $form
   * @return array
   */
  public function getHelps(sfForm $form)
  {
    $scope = get_class($form);

    return isset($this->data['forms'][$scope]) ? $this->data['forms'][$scope] : array();
  }

  /**
   * Returns all data set
   *
   * @return <type>
   */
  public function getData()
  {
    return $this->data;
  }
}
?>
