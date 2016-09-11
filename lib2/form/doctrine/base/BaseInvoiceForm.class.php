<?php

/**
 * Invoice form base class.
 *
 * @method Invoice getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInvoiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'sell_by_date'          => new sfWidgetFormDateTime(),
      'invoice_date'          => new sfWidgetFormDateTime(),
      'place_of_issue'        => new sfWidgetFormTextarea(),
      'seller'                => new sfWidgetFormTextarea(),
      'buyer'                 => new sfWidgetFormTextarea(),
      'service_name'          => new sfWidgetFormTextarea(),
      'net'                   => new sfWidgetFormTextarea(),
      'gross_value'           => new sfWidgetFormTextarea(),
      'vat'                   => new sfWidgetFormTextarea(),
      'total_price'           => new sfWidgetFormTextarea(),
      'vat_rate'              => new sfWidgetFormTextarea(),
      'vat_amount'            => new sfWidgetFormTextarea(),
      'words'                 => new sfWidgetFormTextarea(),
      'paid_by_bank_transfer' => new sfWidgetFormTextarea(),
      'exhibited'             => new sfWidgetFormTextarea(),
      'received'              => new sfWidgetFormTextarea(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sell_by_date'          => new sfValidatorDateTime(),
      'invoice_date'          => new sfValidatorDateTime(),
      'place_of_issue'        => new sfValidatorString(array('required' => false)),
      'seller'                => new sfValidatorString(array('required' => false)),
      'buyer'                 => new sfValidatorString(array('required' => false)),
      'service_name'          => new sfValidatorString(array('required' => false)),
      'net'                   => new sfValidatorString(array('required' => false)),
      'gross_value'           => new sfValidatorString(array('required' => false)),
      'vat'                   => new sfValidatorString(array('required' => false)),
      'total_price'           => new sfValidatorString(array('required' => false)),
      'vat_rate'              => new sfValidatorString(array('required' => false)),
      'vat_amount'            => new sfValidatorString(array('required' => false)),
      'words'                 => new sfValidatorString(array('required' => false)),
      'paid_by_bank_transfer' => new sfValidatorString(array('required' => false)),
      'exhibited'             => new sfValidatorString(array('required' => false)),
      'received'              => new sfValidatorString(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('invoice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoice';
  }

}
