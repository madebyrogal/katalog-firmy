<?php

class CompanyFrontendForm extends CompanyForm
{
    public function configure()
    {
        parent::configure();
        unset($this['packet']);
        unset($this['rent_to']);
        unset($this['rent_from']);
        unset($this['is_paid']);
        unset($this['is_active']);        
        unset($this['Metas']);
        
        $this->widgetSchema['description'] =  new sfWidgetFormTextareaTinyMCE(
            array(
            'width'=>570,
            'height'=>350,
            'config'=>'
                language : "pl",
                plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,",
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true',
            'theme'   =>  sfConfig::get('app_tinymce_theme','advanced'),
            ),
            array(
            'class'   =>  'tiny_mce',
            )
        );
              
            
      $js_path = sfConfig::get('sf_rich_text_js_dir') ? '/'.sfConfig::get('sf_rich_text_js_dir').'/tiny_mce.js' : '/sf/js/tinymce/tiny_mce.js';
      sfContext::getInstance()->getResponse()->addJavascript($js_path);
      
              
      $this->widgetSchema['name']->setLabel('Pełna nazwa firmy');
      $this->widgetSchema['description']->setLabel(false);
      $this->widgetSchema['city']->setLabel('Miasto');
      $this->widgetSchema['post_code']->setLabel('Kod pocztowy');
      $this->widgetSchema['street']->setLabel('Ulica');
      $this->widgetSchema['state']->setLabel('Województwo');
      $this->widgetSchema['phone']->setLabel('Telefon');
      $this->widgetSchema['mobile']->setLabel('Telefon (opcjonalnie)');
      
      $this->widgetSchema['categories_list']->setLabel(false);
      $this->widgetSchema['type_list']->setLabel(false);
        
		$this->widgetSchema['fb'] = new sfWidgetFormInput();
		$this->validatorSchema['fb'] = new sfValidatorString(array('required' => false));
		$this->widgetSchema['fb']->setLabel('Facebook');

		$this->widgetSchema['yt'] = new sfWidgetFormInput();
		$this->validatorSchema['yt'] = new sfValidatorString(array('required' => false));
		$this->widgetSchema['yt']->setLabel('Youtube');
        
    }
}