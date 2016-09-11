<?php

/**
 * Articles2ArtCategories form base class.
 *
 * @method Articles2ArtCategories getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticles2ArtCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id'     => new sfWidgetFormInputHidden(),
      'artcategory_id' => new sfWidgetFormInputHidden(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'article_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_id')), 'empty_value' => $this->getObject()->get('article_id'), 'required' => false)),
      'artcategory_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('artcategory_id')), 'empty_value' => $this->getObject()->get('artcategory_id'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('articles2_art_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articles2ArtCategories';
  }

}
