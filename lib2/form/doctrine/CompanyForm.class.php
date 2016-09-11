<?php

/**
 * Company form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanyForm extends BaseCompanyForm
{
  public function configure()
  {
      $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));
      
      unset($this['created_at']);
      unset($this['updated_at']);
      unset($this['slug']);            
      unset($this['profile_id']);      
      unset($this['maps']);
      unset($this['meta_id']);
      unset($this['email_list']);
			unset($this['packet']);
      
//      $packets = PricesTable::getInstance()->getPackets();      
//      $this->widgetSchema['packet'] = new sfWidgetFormChoice(
//          array(
//            'choices' => $packets
//          ));
      
      $metas = new MetasForm($this->getObject()->getMetas());            
      $this->embedForm('Metas', $metas);
      
      $this->widgetSchema['rent_from'] = new sfWidgetFormJQueryDate();
      $this->widgetSchema['rent_from']->setOption('culture', 'pl');
      $this->widgetSchema['rent_to'] = new sfWidgetFormJQueryDate();
      $this->widgetSchema['rent_to']->setOption('culture', 'pl');
      
      $this->widgetSchema['type_list'] = new sfWidgetFormDoctrineChoice(array(
              'model' => 'Type',
              'expanded' => true,              
              'multiple' => true,
      ));
      
      $state = array();
      $state[''] = "[ Wybierz województwo ]";
      $state['dolnośląskie'] = "dolnośląskie";
      $state['kujawsko-pomorskie'] = "kujawsko-pomorskie";
      $state['lubelskie'] = "lubelskie";
      $state['lubuskie'] = "lubuskie";
      $state['łódzkie'] = "łódzkie";
      $state['małopolskie'] = "małopolskie";
      $state['mazowieckie'] = "mazowieckie";
      $state['opolskie'] = "opolskie";
      $state['podkarpackie'] = "podkarpackie";
      $state['podlaskie'] = "podlaskie";
      $state['pomorskie'] = "pomorskie";
      $state['śląskie'] = "śląskie";
      $state['świętokrzyskie'] = "świętokrzyskie";
      $state['warmińsko-mazurskie'] = "warmińsko-mazurskie";
      $state['wielkopolskie'] = "wielkopolskie";
      $state['zachodniopomorskie'] = "zachodniopomorskie";

      $this->widgetSchema['state'] = new sfWidgetFormChoice(
          array(
             'choices' => $state
          ));
      
      $this->widgetSchema['categories_list'] = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Categories'), 
          'add_empty' => false,
          'order_by' => array('root_id, lft', ''),
          'method' => 'getIndentedName',
          'multiple' => true
      ));            
      
      $this->widgetSchema['gallery_id'] = new sfWidgetFormInputHidden();
      
      
      
  }
}
