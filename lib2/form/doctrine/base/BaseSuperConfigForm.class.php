<?php

/**
 * SuperConfig form base class.
 *
 * @method SuperConfig getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSuperConfigForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'setting'              => new sfWidgetFormInputText(),
      'value'                => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'scope'                => new sfWidgetFormInputText(),
      'is_enabled_for_users' => new sfWidgetFormInputCheckbox(),
      'is_secret'            => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'setting'              => new sfValidatorString(array('max_length' => 255)),
      'value'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'          => new sfValidatorString(array('required' => false)),
      'scope'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_enabled_for_users' => new sfValidatorBoolean(array('required' => false)),
      'is_secret'            => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SuperConfig', 'column' => array('setting')))
    );

    $this->widgetSchema->setNameFormat('super_config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuperConfig';
  }

}
