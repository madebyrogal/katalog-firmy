<?php

/**
 * Sliders filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSlidersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_default' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'width'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'height'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'random'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'is_default' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'width'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'random'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sliders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sliders';
  }

  public function getFields()
  {
    return array(
      'slider_id'  => 'Number',
      'name'       => 'Text',
      'is_default' => 'Boolean',
      'width'      => 'Number',
      'height'     => 'Number',
      'random'     => 'Boolean',
    );
  }
}
