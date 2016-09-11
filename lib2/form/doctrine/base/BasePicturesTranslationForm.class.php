<?php

/**
 * PicturesTranslation form base class.
 *
 * @method PicturesTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePicturesTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'picture_id'     => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'is_lang_active' => new sfWidgetFormInputCheckbox(),
      'lang'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'picture_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('picture_id')), 'empty_value' => $this->getObject()->get('picture_id'), 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_lang_active' => new sfValidatorBoolean(array('required' => false)),
      'lang'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pictures_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PicturesTranslation';
  }

}
