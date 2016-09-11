<?php

/**
 * Articles form base class.
 *
 * @method Articles getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticlesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id'                 => new sfWidgetFormInputHidden(),
      'author_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'artcategory_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtCategories'), 'add_empty' => false)),
      'is_public'                  => new sfWidgetFormInputCheckbox(),
      'is_deletable'               => new sfWidgetFormInputCheckbox(),
      'is_editable'                => new sfWidgetFormInputCheckbox(),
      'meta_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'record_key'                 => new sfWidgetFormInputText(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'extra_art_categories_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories')),
      'galleries_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Galleries')),
      'comments_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Comments')),
      'files_list'                 => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Files')),
      'tags_list'                  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'article_custom_fields_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
    ));

    $this->setValidators(array(
      'article_id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('article_id')), 'empty_value' => $this->getObject()->get('article_id'), 'required' => false)),
      'author_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'artcategory_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ArtCategories'))),
      'is_public'                  => new sfValidatorBoolean(array('required' => false)),
      'is_deletable'               => new sfValidatorBoolean(array('required' => false)),
      'is_editable'                => new sfValidatorBoolean(array('required' => false)),
      'meta_id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'required' => false)),
      'record_key'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'                 => new sfValidatorDateTime(),
      'updated_at'                 => new sfValidatorDateTime(),
      'extra_art_categories_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories', 'required' => false)),
      'galleries_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Galleries', 'required' => false)),
      'comments_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Comments', 'required' => false)),
      'files_list'                 => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Files', 'required' => false)),
      'tags_list'                  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'article_custom_fields_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articles';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['extra_art_categories_list']))
    {
      $this->setDefault('extra_art_categories_list', $this->object->ExtraArtCategories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['galleries_list']))
    {
      $this->setDefault('galleries_list', $this->object->Galleries->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['comments_list']))
    {
      $this->setDefault('comments_list', $this->object->Comments->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['files_list']))
    {
      $this->setDefault('files_list', $this->object->Files->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['article_custom_fields_list']))
    {
      $this->setDefault('article_custom_fields_list', $this->object->ArticleCustomFields->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveExtraArtCategoriesList($con);
    $this->saveGalleriesList($con);
    $this->saveCommentsList($con);
    $this->saveFilesList($con);
    $this->saveTagsList($con);
    $this->saveArticleCustomFieldsList($con);

    parent::doSave($con);
  }

  public function saveExtraArtCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['extra_art_categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ExtraArtCategories->getPrimaryKeys();
    $values = $this->getValue('extra_art_categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ExtraArtCategories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ExtraArtCategories', array_values($link));
    }
  }

  public function saveGalleriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['galleries_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Galleries->getPrimaryKeys();
    $values = $this->getValue('galleries_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Galleries', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Galleries', array_values($link));
    }
  }

  public function saveCommentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['comments_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Comments->getPrimaryKeys();
    $values = $this->getValue('comments_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Comments', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Comments', array_values($link));
    }
  }

  public function saveFilesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['files_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Files->getPrimaryKeys();
    $values = $this->getValue('files_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Files', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Files', array_values($link));
    }
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
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

}
