<?php

/**
 * Order filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'profile_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => true)),
      'company_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Company'), 'add_empty' => true)),
      'status_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'note'         => new sfWidgetFormFilterInput(),
      'invoice_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'add_empty' => true)),
      'value_netto'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value_brutto' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rent_from'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'rent_to'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_paid'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'packet'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'version'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'uid'          => new sfValidatorPass(array('required' => false)),
      'profile_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profile'), 'column' => 'id')),
      'company_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Company'), 'column' => 'id')),
      'status_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'note'         => new sfValidatorPass(array('required' => false)),
      'invoice_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Invoice'), 'column' => 'id')),
      'value_netto'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'value_brutto' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rent_from'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'rent_to'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_paid'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'packet'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'uid'          => 'Text',
      'profile_id'   => 'ForeignKey',
      'company_id'   => 'ForeignKey',
      'status_id'    => 'ForeignKey',
      'note'         => 'Text',
      'invoice_id'   => 'ForeignKey',
      'value_netto'  => 'Number',
      'value_brutto' => 'Number',
      'rent_from'    => 'Date',
      'rent_to'      => 'Date',
      'is_paid'      => 'Boolean',
      'packet'       => 'Number',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'version'      => 'Number',
    );
  }
}
