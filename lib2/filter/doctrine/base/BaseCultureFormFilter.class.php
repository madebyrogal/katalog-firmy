<?php

/**
 * Culture filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCultureFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_deleted' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'position'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country'    => new sfValidatorPass(array('required' => false)),
      'label'      => new sfValidatorPass(array('required' => false)),
      'is_active'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_deleted' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'position'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('culture_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Culture';
  }

  public function getFields()
  {
    return array(
      'language'   => 'Text',
      'country'    => 'Text',
      'label'      => 'Text',
      'is_active'  => 'Boolean',
      'is_deleted' => 'Boolean',
      'position'   => 'Number',
    );
  }
}
