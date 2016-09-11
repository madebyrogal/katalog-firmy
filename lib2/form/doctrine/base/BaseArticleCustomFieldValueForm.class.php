<?php

/**
 * ArticleCustomFieldValue form base class.
 *
 * @method ArticleCustomFieldValue getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticleCustomFieldValueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id' => new sfWidgetFormInputHidden(),
      'field_id'   => new sfWidgetFormInputHidden(),
      'value'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'article_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_id')), 'empty_value' => $this->getObject()->get('article_id'), 'required' => false)),
      'field_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('field_id')), 'empty_value' => $this->getObject()->get('field_id'), 'required' => false)),
      'value'      => new sfValidatorString(array('max_length' => 1024)),
    ));

    $this->widgetSchema->setNameFormat('article_custom_field_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleCustomFieldValue';
  }

}
