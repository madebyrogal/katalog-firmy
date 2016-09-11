<?php

/**
 * Invoice filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInvoiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sell_by_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'invoice_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'place_of_issue'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seller'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'buyer'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'service_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'net'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gross_value'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vat'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total_price'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vat_rate'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vat_amount'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'words'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paid_by_bank_transfer' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'exhibited'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'received'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'sell_by_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'invoice_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'place_of_issue'        => new sfValidatorPass(array('required' => false)),
      'seller'                => new sfValidatorPass(array('required' => false)),
      'buyer'                 => new sfValidatorPass(array('required' => false)),
      'service_name'          => new sfValidatorPass(array('required' => false)),
      'net'                   => new sfValidatorPass(array('required' => false)),
      'gross_value'           => new sfValidatorPass(array('required' => false)),
      'vat'                   => new sfValidatorPass(array('required' => false)),
      'total_price'           => new sfValidatorPass(array('required' => false)),
      'vat_rate'              => new sfValidatorPass(array('required' => false)),
      'vat_amount'            => new sfValidatorPass(array('required' => false)),
      'words'                 => new sfValidatorPass(array('required' => false)),
      'paid_by_bank_transfer' => new sfValidatorPass(array('required' => false)),
      'exhibited'             => new sfValidatorPass(array('required' => false)),
      'received'              => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('invoice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoice';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'sell_by_date'          => 'Date',
      'invoice_date'          => 'Date',
      'place_of_issue'        => 'Text',
      'seller'                => 'Text',
      'buyer'                 => 'Text',
      'service_name'          => 'Text',
      'net'                   => 'Text',
      'gross_value'           => 'Text',
      'vat'                   => 'Text',
      'total_price'           => 'Text',
      'vat_rate'              => 'Text',
      'vat_amount'            => 'Text',
      'words'                 => 'Text',
      'paid_by_bank_transfer' => 'Text',
      'exhibited'             => 'Text',
      'received'              => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
