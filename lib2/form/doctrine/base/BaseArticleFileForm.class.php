<?php

/**
 * ArticleFile form base class.
 *
 * @method ArticleFile getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticleFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id' => new sfWidgetFormInputHidden(),
      'file_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'article_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_id')), 'empty_value' => $this->getObject()->get('article_id'), 'required' => false)),
      'file_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('file_id')), 'empty_value' => $this->getObject()->get('file_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleFile';
  }

}
