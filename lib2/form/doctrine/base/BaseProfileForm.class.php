<?php

/**
 * Profile form base class.
 *
 * @method Profile getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GuardUser'), 'add_empty' => false)),
      'name'          => new sfWidgetFormInputText(),
      'city'          => new sfWidgetFormInputText(),
      'post_code'     => new sfWidgetFormInputText(),
      'street'        => new sfWidgetFormInputText(),
      'state'         => new sfWidgetFormInputText(),
      'nip'           => new sfWidgetFormInputText(),
      'phone'         => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'guard_user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GuardUser'))),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'city'          => new sfValidatorString(array('max_length' => 255)),
      'post_code'     => new sfValidatorString(array('max_length' => 255)),
      'street'        => new sfValidatorString(array('max_length' => 255)),
      'state'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nip'           => new sfValidatorString(array('max_length' => 255)),
      'phone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Profile', 'column' => array('guard_user_id')))
    );

    $this->widgetSchema->setNameFormat('profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

}
