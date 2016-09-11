<?php

/**
 * ArticlesVersionTranslation form base class.
 *
 * @method ArticlesVersionTranslation getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticlesVersionTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_version_id' => new sfWidgetFormInputHidden(),
      'title'              => new sfWidgetFormInputText(),
      'content'            => new sfWidgetFormTextarea(),
      'is_lang_active'     => new sfWidgetFormInputCheckbox(),
      'lang'               => new sfWidgetFormInputHidden(),
      'slug'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'article_version_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_version_id')), 'empty_value' => $this->getObject()->get('article_version_id'), 'required' => false)),
      'title'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'            => new sfValidatorString(array('required' => false)),
      'is_lang_active'     => new sfValidatorBoolean(array('required' => false)),
      'lang'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
      'slug'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ArticlesVersionTranslation', 'column' => array('slug', 'lang', 'title')))
    );

    $this->widgetSchema->setNameFormat('articles_version_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticlesVersionTranslation';
  }

}
