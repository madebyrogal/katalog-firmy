<?php

class AdSettings implements SettingsInterface
{
    public $values = array();
    public $object;

    public function  __construct($object = false)
    {
      $this->object = $object;
      $this->values[] = array('key' => 'ad_per_page', 'type' => 'string', 'label' => 'Liczba ogłoszeń na stronie', 'default' => 'ad_per_page_default');
      $this->values[] = array('key' => 'ad_short_len', 'type' => 'string', 'label' => 'Ilość znaków ogłoszenia na liście', 'default' => 'ad_per_page_default');
    }

    public function getValues()
    {
        return $this->values;
    }

    public function getSettingsForObject()
    {
        $settings = array();
        $defaultSettings = stgConfig::getGroup($this->getDefaultScope());
        $objectSettings = stgConfig::getGroup($this->getScope().$this->object->getPrimaryKey());
        $settings = $this->diffSettings($defaultSettings, $objectSettings);

        return $settings;
    }

    public function getSettings()
    {
        $settings = stgConfig::getGroup($this->getDefaultScope());
        $defaultSettings = $this->getDefaultSettings($settings);
//        $objectSettings = stgConfig::getGroup($this->getScope());
//        $settings = $this->diffSettings($defaultSettings, $objectSettings);
        return $defaultSettings;
//        return $settings;
    }

    public function getScope()
    {
        return 'AD_';
    }

    public function getDefaultScope()
    {
        return 'AD';
    }

    public function getDefaultSettings($settings)
    {
      $default_settings = array();
      foreach($this->values as $value)
      {
        if (isset($settings[$value['key'].'_default'])) {
          $default_settings[$value['key']] = $settings[$value['key'].'_default'];
        }
      }
      return $default_settings;
    }

    public function diffSettings($defaultSettings, $objectSettings)
    {
        $settings = array();
        foreach($this->values as $value)
        {
            $settings[$value['key']] = (isset($objectSettings[$value['key'].'_'.$this->object->getPrimaryKey()])) ? $objectSettings[$value['key'].'_'.$this->object->getPrimaryKey()] : $defaultSettings[$value['key'].'_default'];
        }
        return $settings;
    }

}