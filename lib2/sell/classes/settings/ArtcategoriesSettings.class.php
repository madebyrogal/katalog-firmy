<?php

class ArtcategoriesSettings implements SettingsInterface
{
    public $values = array();
    public $object;

    public function  __construct($object = false)
    {
        $this->object = $object;
//        $this->values[] = array('key' => 'artcategories_show_category', 'type' => 'bool', 'label' => 'Wyświetlać nazwę kategorii', 'default' => 'artcategories_show_category_default');
//        $this->values[] = array('key' => 'artcategories_show_created_at', 'type' => 'bool', 'label' => 'Wyświetlać datę dodania', 'default' => 'artcategories_show_created_at_default');
//        $this->values[] = array('key' => 'artcategories_show_author', 'type' => 'bool', 'label' => 'Wyświetlać autora tekstu', 'default' => 'artcategories_show_author_default');
//        $this->values[] = array('key' => 'artcategories_show_updated_at', 'type' => 'bool', 'label' => 'Wyświetlać datę modyfikacji', 'default' => 'artcategories_show_updated_at_default');
        $this->values[] = array('key' => 'artcategories_short_len', 'type' => 'string', 'label' => 'Ilość znaków artykułu/tekstu na liście', 'default' => 'artcategories_short_len_default');
        $this->values[] = array('key' => 'artcategories_per_page', 'type' => 'string', 'label' => 'Liczba tekstów na stronie', 'default' => 'artcategories_per_page_default');
        
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
        return 'ARTCATEGORIES_';
    }

    public function getDefaultScope()
    {
        return 'ARTCATEGORIES';
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