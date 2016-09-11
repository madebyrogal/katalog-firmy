<?php

class GalleriesSettings implements SettingsInterface
{
    public $values = array();
    public $object;

    public function  __construct($object = false)
    {
        $this->object = $object;
        $this->values[] = array('key' => 'galleries_per_page', 'type' => 'string', 'label' => 'Liczba obrazków na stronie', 'default' => 'galleries_per_page_default');
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

    public function getScope()
    {
        return 'GALLERIES_';
    }

    public function getDefaultScope()
    {
        return 'GALLERIES';
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