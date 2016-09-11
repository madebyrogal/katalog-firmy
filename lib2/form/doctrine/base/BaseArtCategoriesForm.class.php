<?php

/**
 * ArtCategories form base class.
 *
 * @method ArtCategories getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'artcategory_id'             => new sfWidgetFormInputHidden(),
      'tree_key'                   => new sfWidgetFormInputText(),
      'is_public'                  => new sfWidgetFormInputCheckbox(),
      'is_deletable'               => new sfWidgetFormInputCheckbox(),
      'is_editable'                => new sfWidgetFormInputCheckbox(),
      'meta_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'record_key'                 => new sfWidgetFormInputText(),
      'gallery_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => false)),
      'root_id'                    => new sfWidgetFormInputText(),
      'lft'                        => new sfWidgetFormInputText(),
      'rgt'                        => new sfWidgetFormInputText(),
      'level'                      => new sfWidgetFormInputText(),
      'extra_articles_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'article_custom_fields_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
      'article_custom_field_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
    ));

    $this->setValidators(array(
      'artcategory_id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('artcategory_id')), 'empty_value' => $this->getObject()->get('artcategory_id'), 'required' => false)),
      'tree_key'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_public'                  => new sfValidatorBoolean(array('required' => false)),
      'is_deletable'               => new sfValidatorBoolean(array('required' => false)),
      'is_editable'                => new sfValidatorBoolean(array('required' => false)),
      'meta_id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'required' => false)),
      'record_key'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'gallery_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'))),
      'root_id'                    => new sfValidatorInteger(array('required' => false)),
      'lft'                        => new sfValidatorInteger(array('required' => false)),
      'rgt'                        => new sfValidatorInteger(array('required' => false)),
      'level'                      => new sfValidatorInteger(array('required' => false)),
      'extra_articles_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'article_custom_fields_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
      'article_custom_field_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('art_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtCategories';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['extra_articles_list']))
    {
      $this->setDefault('extra_articles_list', $this->object->ExtraArticles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['article_custom_fields_list']))
    {
      $this->setDefault('article_custom_fields_list', $this->object->ArticleCustomFields->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['article_custom_field_list']))
    {
      $this->setDefault('article_custom_field_list', $this->object->ArticleCustomField->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveExtraArticlesList($con);
    $this->saveArticleCustomFieldsList($con);
    $this->saveArticleCustomFieldList($con);

    parent::doSave($con);
  }

  public function saveExtraArticlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['extra_articles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ExtraArticles->getPrimaryKeys();
    $values = $this->getValue('extra_articles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ExtraArticles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ExtraArticles', array_values($link));
    }
  }

  public function saveArticleCustomFieldsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['article_custom_fields_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ArticleCustomFields->getPrimaryKeys();
    $values = $this->getValue('article_custom_fields_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ArticleCustomFields', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ArticleCustomFields', array_values($link));
    }
  }

  public function saveArticleCustomFieldList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['article_custom_field_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ArticleCustomField->getPrimaryKeys();
    $values = $this->getValue('article_custom_field_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ArticleCustomField', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ArticleCustomField', array_values($link));
    }
  }

}
