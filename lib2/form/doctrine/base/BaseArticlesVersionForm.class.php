<?php

/**
 * ArticlesVersion form base class.
 *
 * @method ArticlesVersion getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticlesVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_version_id' => new sfWidgetFormInputHidden(),
      'article_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Articles'), 'add_empty' => false)),
      'author_id'          => new sfWidgetFormInputText(),
      'artcategory_id'     => new sfWidgetFormInputText(),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'article_version_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_version_id')), 'empty_value' => $this->getObject()->get('article_version_id'), 'required' => false)),
      'article_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Articles'))),
      'author_id'          => new sfValidatorInteger(array('required' => false)),
      'artcategory_id'     => new sfValidatorInteger(),
      'is_active'          => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('articles_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticlesVersion';
  }

}
