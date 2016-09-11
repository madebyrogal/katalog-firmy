<?php

/**
 * Order form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderForm extends BaseOrderForm
{
  public function configure()
  {
      $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));
      
      unset($this['uid']);
      unset($this['version']);
      unset($this['invoice_id']);
      unset($this['company_id']);
      unset($this['profile_id']);
      unset($this['created_at']);
      unset($this['updated_at']);
      unset($this['packet']);
      unset($this['rent_from']);
      unset($this['rent_to']);
      
      $this->widgetSchema['company'] = new sfWidgetFormInput(array(), array('disabled' => true));
      $this->widgetSchema->setDefault('company', $this->getObject()->getCompany()->getName());
      $this->widgetSchema['profile'] = new sfWidgetFormInput(array(), array('disabled' => true));
      $this->widgetSchema->setDefault('profile', $this->getObject()->getProfile()->getGuardUser()->getUsername());
      
      $packets = PricesTable::getInstance()->getPackets();   
      $this->widgetSchema['packet_name'] = new sfWidgetFormInput(array(), array('disabled' => true));
      $this->widgetSchema->setDefault('packet_name', $packets[$this->getObject()->getPacket()]);
      
      $this->widgetSchema['rent_from'] = new sfWidgetFormInput(array(), array('disabled' => true));
      $this->widgetSchema['rent_to'] = new sfWidgetFormInput(array(), array('disabled' => true));
      
      if($this->getObject()->getIsPaid())
      {
          unset($this['value_netto']);
          unset($this['value_brutto']);
          unset($this['is_paid']);
          $this->widgetSchema['value_netto'] = new sfWidgetFormInput(array(), array('disabled' => true));
          $this->widgetSchema['value_brutto'] = new sfWidgetFormInput(array(), array('disabled' => true));
          $this->widgetSchema['is_paid'] = new sfWidgetFormInputCheckbox(array(), array('disabled' => true));
      }
      
  }
}
