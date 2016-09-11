<?php

/**
 * MetasTranslation form base class.
 *
 * @method MetasTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMetasTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'meta_id'      => new sfWidgetFormInputHidden(),
      'generate'     => new sfWidgetFormInputCheckbox(),
      'title'        => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormInputText(),
      'keywords'     => new sfWidgetFormInputText(),
      'copyright'    => new sfWidgetFormInputText(),
      'author'       => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'distribution' => new sfWidgetFormInputText(),
      'rating'       => new sfWidgetFormInputText(),
      'robots'       => new sfWidgetFormInputText(),
      'revisitafter' => new sfWidgetFormInputText(),
      'expires'      => new sfWidgetFormInputText(),
      'lang'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'meta_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('meta_id')), 'empty_value' => $this->getObject()->get('meta_id'), 'required' => false)),
      'generate'     => new sfValidatorBoolean(array('required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'copyright'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'distribution' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rating'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'robots'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'revisitafter' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'expires'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('metas_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MetasTranslation';
  }

}
