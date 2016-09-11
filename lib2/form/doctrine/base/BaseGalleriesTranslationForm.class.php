<?php

/**
 * GalleriesTranslation form base class.
 *
 * @method GalleriesTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGalleriesTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gallery_id'     => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'is_lang_active' => new sfWidgetFormInputCheckbox(),
      'lang'           => new sfWidgetFormInputHidden(),
      'slug'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'gallery_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gallery_id')), 'empty_value' => $this->getObject()->get('gallery_id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_lang_active' => new sfValidatorBoolean(array('required' => false)),
      'lang'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'GalleriesTranslation', 'column' => array('slug', 'lang', 'name')))
    );

    $this->widgetSchema->setNameFormat('galleries_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GalleriesTranslation';
  }

}
