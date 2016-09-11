<?php

/**
 * FilesTranslation form base class.
 *
 * @method FilesTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFilesTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file_id'        => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormTextarea(),
      'is_lang_active' => new sfWidgetFormInputCheckbox(),
      'lang'           => new sfWidgetFormInputHidden(),
      'slug'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'file_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('file_id')), 'empty_value' => $this->getObject()->get('file_id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'    => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'is_lang_active' => new sfValidatorBoolean(array('required' => false)),
      'lang'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'FilesTranslation', 'column' => array('slug', 'lang', 'name')))
    );

    $this->widgetSchema->setNameFormat('files_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilesTranslation';
  }

}
