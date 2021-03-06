<?php

/**
 * ArticlesVersionTranslation filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticlesVersionTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_lang_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'slug'               => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'              => new sfValidatorPass(array('required' => false)),
      'content'            => new sfValidatorPass(array('required' => false)),
      'is_lang_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'slug'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articles_version_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticlesVersionTranslation';
  }

  public function getFields()
  {
    return array(
      'article_version_id' => 'Number',
      'title'              => 'Text',
      'content'            => 'Text',
      'is_lang_active'     => 'Boolean',
      'lang'               => 'Text',
      'slug'               => 'Text',
    );
  }
}
