<?php

/**
 * StgLogUserActions filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStgLogUserActionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'module'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'params'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sf_format'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user'       => new sfValidatorPass(array('required' => false)),
      'module'     => new sfValidatorPass(array('required' => false)),
      'action'     => new sfValidatorPass(array('required' => false)),
      'params'     => new sfValidatorPass(array('required' => false)),
      'sf_format'  => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('stg_log_user_actions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StgLogUserActions';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'user'       => 'Text',
      'module'     => 'Text',
      'action'     => 'Text',
      'params'     => 'Text',
      'sf_format'  => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
