<?php

/**
 * Currency filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCurrencyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'symbol'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'language'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_default'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rate'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'symbol'      => new sfValidatorPass(array('required' => false)),
      'language'    => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_default'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rate'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('currency_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Currency';
  }

  public function getFields()
  {
    return array(
      'currency_id' => 'Number',
      'name'        => 'Text',
      'symbol'      => 'Text',
      'language'    => 'Text',
      'is_active'   => 'Boolean',
      'is_default'  => 'Boolean',
      'rate'        => 'Number',
    );
  }
}
