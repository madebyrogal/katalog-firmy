<?php

/**
 * Articles filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticlesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'author_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'artcategory_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtCategories'), 'add_empty' => true)),
      'is_public'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_deletable'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_editable'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'meta_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'record_key'                 => new sfWidgetFormFilterInput(),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'extra_art_categories_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories')),
      'galleries_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Galleries')),
      'comments_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Comments')),
      'files_list'                 => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Files')),
      'tags_list'                  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'article_custom_fields_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
    ));

    $this->setValidators(array(
      'author_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'artcategory_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ArtCategories'), 'column' => 'artcategory_id')),
      'is_public'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_deletable'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_editable'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'meta_id'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Metas'), 'column' => 'meta_id')),
      'record_key'                 => new sfValidatorPass(array('required' => false)),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'extra_art_categories_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories', 'required' => false)),
      'galleries_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Galleries', 'required' => false)),
      'comments_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Comments', 'required' => false)),
      'files_list'                 => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Files', 'required' => false)),
      'tags_list'                  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'article_custom_fields_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addExtraArtCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.Articles2ArtCategories Articles2ArtCategories')
      ->andWhereIn('Articles2ArtCategories.artcategory_id', $values)
    ;
  }

  public function addGalleriesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ArticleGallery ArticleGallery')
      ->andWhereIn('ArticleGallery.gallery_id', $values)
    ;
  }

  public function addCommentsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.CommentArticle CommentArticle')
      ->andWhereIn('CommentArticle.comment_id', $values)
    ;
  }

  public function addFilesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ArticleFile ArticleFile')
      ->andWhereIn('ArticleFile.file_id', $values)
    ;
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.Article2Tag Article2Tag')
      ->andWhereIn('Article2Tag.tag_id', $values)
    ;
  }

  public function addArticleCustomFieldsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ArticleCustomFieldValue ArticleCustomFieldValue')
      ->andWhereIn('ArticleCustomFieldValue.id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Articles';
  }

  public function getFields()
  {
    return array(
      'article_id'                 => 'Number',
      'author_id'                  => 'ForeignKey',
      'artcategory_id'             => 'ForeignKey',
      'is_public'                  => 'Boolean',
      'is_deletable'               => 'Boolean',
      'is_editable'                => 'Boolean',
      'meta_id'                    => 'ForeignKey',
      'record_key'                 => 'Text',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'extra_art_categories_list'  => 'ManyKey',
      'galleries_list'             => 'ManyKey',
      'comments_list'              => 'ManyKey',
      'files_list'                 => 'ManyKey',
      'tags_list'                  => 'ManyKey',
      'article_custom_fields_list' => 'ManyKey',
    );
  }
}
