<?php

/**
 * Currency form base class.
 *
 * @method Currency getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCurrencyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'currency_id' => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'symbol'      => new sfWidgetFormInputText(),
      'language'    => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'is_default'  => new sfWidgetFormInputCheckbox(),
      'rate'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'currency_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('currency_id')), 'empty_value' => $this->getObject()->get('currency_id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'symbol'      => new sfValidatorString(array('max_length' => 15)),
      'language'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'is_default'  => new sfValidatorBoolean(array('required' => false)),
      'rate'        => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('currency[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Currency';
  }

}
