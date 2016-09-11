<?php

/**
 * Culture form base class.
 *
 * @method Culture getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCultureForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'language'   => new sfWidgetFormInputHidden(),
      'country'    => new sfWidgetFormInputText(),
      'label'      => new sfWidgetFormInputText(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'is_deleted' => new sfWidgetFormInputCheckbox(),
      'position'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'language'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('language')), 'empty_value' => $this->getObject()->get('language'), 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 255)),
      'label'      => new sfValidatorString(array('max_length' => 255)),
      'is_active'  => new sfValidatorBoolean(array('required' => false)),
      'is_deleted' => new sfValidatorBoolean(array('required' => false)),
      'position'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Culture', 'column' => array('position')))
    );

    $this->widgetSchema->setNameFormat('culture[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Culture';
  }

}
