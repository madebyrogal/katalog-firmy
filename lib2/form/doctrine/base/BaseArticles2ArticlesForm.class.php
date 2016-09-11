<?php

/**
 * Articles2Articles form base class.
 *
 * @method Articles2Articles getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticles2ArticlesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_1_id' => new sfWidgetFormInputHidden(),
      'article_2_id' => new sfWidgetFormInputHidden(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'article_1_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_1_id')), 'empty_value' => $this->getObject()->get('article_1_id'), 'required' => false)),
      'article_2_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_2_id')), 'empty_value' => $this->getObject()->get('article_2_id'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('articles2_articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articles2Articles';
  }

}
