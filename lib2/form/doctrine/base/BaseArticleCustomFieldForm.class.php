<?php

/**
 * ArticleCustomField form base class.
 *
 * @method ArticleCustomField getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticleCustomFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'type'                => new sfWidgetFormInputText(),
      'record_key'          => new sfWidgetFormInputText(),
      'articles_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'art_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255)),
      'type'                => new sfValidatorString(array('max_length' => 255)),
      'record_key'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'articles_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'art_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article_custom_field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleCustomField';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_list']))
    {
      $this->setDefault('articles_list', $this->object->Articles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['art_categories_list']))
    {
      $this->setDefault('art_categories_list', $this->object->ArtCategories->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesList($con);
    $this->saveArtCategoriesList($con);

    parent::doSave($con);
  }

  public function saveArticlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['articles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Articles->getPrimaryKeys();
    $values = $this->getValue('articles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Articles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Articles', array_values($link));
    }
  }

  public function saveArtCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['art_categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ArtCategories->getPrimaryKeys();
    $values = $this->getValue('art_categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ArtCategories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ArtCategories', array_values($link));
    }
  }

}
