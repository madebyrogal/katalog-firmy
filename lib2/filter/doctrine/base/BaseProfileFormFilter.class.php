<?php

/**
 * Profile filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GuardUser'), 'add_empty' => true)),
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'city'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'post_code'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'street'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nip'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GuardUser'), 'column' => 'id')),
      'name'          => new sfValidatorPass(array('required' => false)),
      'city'          => new sfValidatorPass(array('required' => false)),
      'post_code'     => new sfValidatorPass(array('required' => false)),
      'street'        => new sfValidatorPass(array('required' => false)),
      'state'         => new sfValidatorPass(array('required' => false)),
      'nip'           => new sfValidatorPass(array('required' => false)),
      'phone'         => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'guard_user_id' => 'ForeignKey',
      'name'          => 'Text',
      'city'          => 'Text',
      'post_code'     => 'Text',
      'street'        => 'Text',
      'state'         => 'Text',
      'nip'           => 'Text',
      'phone'         => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
