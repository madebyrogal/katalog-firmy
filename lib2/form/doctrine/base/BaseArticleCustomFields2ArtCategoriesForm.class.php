<?php

/**
 * ArticleCustomFields2ArtCategories form base class.
 *
 * @method ArticleCustomFields2ArtCategories getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticleCustomFields2ArtCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'artcategory_id' => new sfWidgetFormInputHidden(),
      'field_id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'artcategory_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('artcategory_id')), 'empty_value' => $this->getObject()->get('artcategory_id'), 'required' => false)),
      'field_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('field_id')), 'empty_value' => $this->getObject()->get('field_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article_custom_fields2_art_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleCustomFields2ArtCategories';
  }

}
