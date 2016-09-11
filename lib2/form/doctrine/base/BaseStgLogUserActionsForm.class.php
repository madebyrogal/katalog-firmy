<?php

/**
 * StgLogUserActions form base class.
 *
 * @method StgLogUserActions getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStgLogUserActionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user'       => new sfWidgetFormInputText(),
      'module'     => new sfWidgetFormInputText(),
      'action'     => new sfWidgetFormInputText(),
      'params'     => new sfWidgetFormInputText(),
      'sf_format'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'module'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sf_format'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('stg_log_user_actions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StgLogUserActions';
  }

}
