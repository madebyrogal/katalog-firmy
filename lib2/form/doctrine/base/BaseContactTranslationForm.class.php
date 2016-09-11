<?php

/**
 * ContactTranslation form base class.
 *
 * @method ContactTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contact_id'       => new sfWidgetFormInputHidden(),
      'message_title'    => new sfWidgetFormInputText(),
      'address'          => new sfWidgetFormTextarea(),
      'map_address'      => new sfWidgetFormTextarea(),
      'map_localization' => new sfWidgetFormTextarea(),
      'form_email'       => new sfWidgetFormInputText(),
      'lang'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'contact_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('contact_id')), 'empty_value' => $this->getObject()->get('contact_id'), 'required' => false)),
      'message_title'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'          => new sfValidatorString(array('required' => false)),
      'map_address'      => new sfValidatorString(array('required' => false)),
      'map_localization' => new sfValidatorString(array('required' => false)),
      'form_email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactTranslation';
  }

}
