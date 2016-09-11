<?php

/**
 * Prices form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PricesForm extends BasePricesForm
{
  public function configure()
  {
      $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));
      
      unset($this['created_at']);
      unset($this['updated_at']);
      unset($this['is_deletable']);
      
      $packets = PricesTable::getInstance()->getPackets();
      
        $this->widgetSchema['packet'] = new sfWidgetFormChoice(
            array(
             'choices' => $packets
            ));
      
  }
}
