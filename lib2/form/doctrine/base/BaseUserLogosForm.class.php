<?php

/**
 * UserLogos form base class.
 *
 * @method UserLogos getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserLogosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_logo_id' => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormTextarea(),
      'file'         => new sfWidgetFormTextarea(),
      'is_active'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'user_logo_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_logo_id')), 'empty_value' => $this->getObject()->get('user_logo_id'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'file'         => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'is_active'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_logos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserLogos';
  }

}
