<?php

/**
 * SuperConfig filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSuperConfigFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'setting'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'scope'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_enabled_for_users' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_secret'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'setting'              => new sfValidatorPass(array('required' => false)),
      'value'                => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
      'scope'                => new sfValidatorPass(array('required' => false)),
      'is_enabled_for_users' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_secret'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('super_config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuperConfig';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'setting'              => 'Text',
      'value'                => 'Text',
      'description'          => 'Text',
      'scope'                => 'Text',
      'is_enabled_for_users' => 'Boolean',
      'is_secret'            => 'Boolean',
    );
  }
}
