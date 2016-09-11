<?php

/**
 * ArtCategories filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArtCategoriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tree_key'                   => new sfWidgetFormFilterInput(),
      'is_public'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_deletable'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_editable'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'meta_id'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'record_key'                 => new sfWidgetFormFilterInput(),
      'gallery_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => true)),
      'root_id'                    => new sfWidgetFormFilterInput(),
      'lft'                        => new sfWidgetFormFilterInput(),
      'rgt'                        => new sfWidgetFormFilterInput(),
      'level'                      => new sfWidgetFormFilterInput(),
      'extra_articles_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'article_custom_fields_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
      'article_custom_field_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField')),
    ));

    $this->setValidators(array(
      'tree_key'                   => new sfValidatorPass(array('required' => false)),
      'is_public'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_deletable'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_editable'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'meta_id'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Metas'), 'column' => 'meta_id')),
      'record_key'                 => new sfValidatorPass(array('required' => false)),
      'gallery_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Galleries'), 'column' => 'gallery_id')),
      'root_id'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extra_articles_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'article_custom_fields_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
      'article_custom_field_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArticleCustomField', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('art_categories_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addExtraArticlesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('Articles2ArtCategories.article_id', $values)
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
      ->leftJoin($query->getRootAlias().'.ArticleCustomFields2ArtCategories ArticleCustomFields2ArtCategories')
      ->andWhereIn('ArticleCustomFields2ArtCategories.field_id', $values)
    ;
  }

  public function addArticleCustomFieldListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ArticleCustomFields2ArtCategories ArticleCustomFields2ArtCategories')
      ->andWhereIn('ArticleCustomFields2ArtCategories.id', $values)
    ;
  }

  public function getModelName()
  {
    return 'ArtCategories';
  }

  public function getFields()
  {
    return array(
      'artcategory_id'             => 'Number',
      'tree_key'                   => 'Text',
      'is_public'                  => 'Boolean',
      'is_deletable'               => 'Boolean',
      'is_editable'                => 'Boolean',
      'meta_id'                    => 'ForeignKey',
      'record_key'                 => 'Text',
      'gallery_id'                 => 'ForeignKey',
      'root_id'                    => 'Number',
      'lft'                        => 'Number',
      'rgt'                        => 'Number',
      'level'                      => 'Number',
      'extra_articles_list'        => 'ManyKey',
      'article_custom_fields_list' => 'ManyKey',
      'article_custom_field_list'  => 'ManyKey',
    );
  }
}
