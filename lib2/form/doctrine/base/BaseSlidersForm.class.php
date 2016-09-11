<?php

/**
 * Sliders form base class.
 *
 * @method Sliders getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSlidersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slider_id'  => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'is_default' => new sfWidgetFormInputCheckbox(),
      'width'      => new sfWidgetFormInputText(),
      'height'     => new sfWidgetFormInputText(),
      'random'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'slider_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('slider_id')), 'empty_value' => $this->getObject()->get('slider_id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'is_default' => new sfValidatorBoolean(array('required' => false)),
      'width'      => new sfValidatorInteger(),
      'height'     => new sfValidatorInteger(),
      'random'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sliders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sliders';
  }

}
