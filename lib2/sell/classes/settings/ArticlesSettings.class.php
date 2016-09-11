<?php

class ArticlesSettings implements SettingsInterface
{
    public $values = array();
    public $object;

    public function  __construct($object = false)
    {
        $this->object = $object;
//        $this->values[] = array('key' => 'articles_show_category', 'type' => 'bool', 'label' => 'Wyświetlać nazwę kategorii', 'default' => 'articles_show_category_default');
//        $this->values[] = array('key' => 'articles_show_created_at', 'type' => 'bool', 'label' => 'Wyświetlać datę dodania', 'default' => 'articles_show_created_at_default');
//        $this->values[] = array('key' => 'articles_show_author', 'type' => 'bool', 'label' => 'Wyświetlać autora tekstu', 'default' => 'articles_show_author_default');
//        $this->values[] = array('key' => 'articles_show_updated_at', 'type' => 'bool', 'label' => 'Wyświetlać datę modyfikacji', 'default' => 'articles_show_updated_at_default');
//        $this->values[] = array('key' => 'articles_show_buttons', 'type' => 'bool', 'label' => 'Wyświetlać przyciski (rss, print itd.)?', 'default' => 'articles_show_buttons_default');
//        $this->values[] = array('key' => 'articles_allow_pdf', 'type' => 'bool', 'label' => 'Czy wyświetlać przycisk pdf?', 'default' => 'articles_allow_pdf_default');
//        $this->values[] = array('key' => 'articles_allow_email', 'type' => 'bool', 'label' => 'Czy wyświetlać przycisk email?', 'default' => 'articles_allow_email_default');
//        $this->values[] = array('key' => 'articles_allow_print', 'type' => 'bool', 'label' => 'Czy wyświetlać przycisk print?', 'default' => 'articles_allow_print_default');
//        $this->values[] = array('key' => 'articles_allow_rss', 'type' => 'bool', 'label' => 'Czy wyświetlać przycisk rss?', 'default' => 'articles_allow_rss_default');
//        $this->values[] = array('key' => 'articles_show_comments', 'type' => 'bool', 'label' => 'Czy wyświetlać komentarze?', 'default' => 'articles_show_comments_default');
//        $this->values[] = array('key' => 'articles_pictures_show_title', 'type' => 'bool', 'label' => 'Czy wyświetlać nazwę zdjęcia?', 'default' => 'articles_pictures_show_title_default');
//        $this->values[] = array('key' => 'articles_pictures_show_rate', 'type' => 'bool', 'label' => 'Czy wyświetlać oceny zdjęcia?', 'default' => 'articles_pictures_show_rate_default');
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
        return 'ARTICLES_';
    }

    public function getDefaultScope()
    {
        return 'ARTICLES';
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