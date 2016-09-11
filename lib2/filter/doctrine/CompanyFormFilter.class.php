<?php

/**
 * Company filter form.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanyFormFilter extends BaseCompanyFormFilter
{
  public function configure()
  {
      
      unset($this['profile_id']);
      unset($this['gallery_id']);
      unset($this['meta_id']);
      unset($this['description']);
      unset($this['post_code']);
      unset($this['nip']);
      unset($this['street']);
      unset($this['maps']);
      unset($this['phone']);
      unset($this['mobile']);
      unset($this['fax']);
      unset($this['www']);
      unset($this['rent_from']);
      unset($this['rent_to']);      
      unset($this['updated_at']);
      unset($this['slug']);
      unset($this['categories_list']);
      unset($this['type_list']);
      
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
             'choices' => $state,              
          ));
     
      $packets = PricesTable::getInstance()->getPackets();      
      $this->widgetSchema['packet'] = new sfWidgetFormChoice(
          array(
            'choices' => array('' => '') + $packets
          ));
      
      $this->validatorSchema['packet'] = new sfValidatorInteger(array('required' => false));     
      
  }
  
  public function addStateColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (isset($values))
    {
      $query->andWhere('state =?', $values);
    }
  }
  
  public function addPacketColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (isset($values))
    {
      $query->andWhere('packet =?', $values);
    }
  }
}
