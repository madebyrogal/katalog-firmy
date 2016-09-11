<?php

/**
 * ArticleCustomField filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticleCustomFieldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'record_key'          => new sfWidgetFormFilterInput(),
      'articles_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'art_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories')),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'type'                => new sfValidatorPass(array('required' => false)),
      'record_key'          => new sfValidatorPass(array('required' => false)),
      'articles_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'art_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ArtCategories', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article_custom_field_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addArticlesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ArticleCustomFieldValue.article_id', $values)
    ;
  }

  public function addArtCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ArticleCustomFields2ArtCategories.artcategory_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'ArticleCustomField';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'type'                => 'Text',
      'record_key'          => 'Text',
      'articles_list'       => 'ManyKey',
      'art_categories_list' => 'ManyKey',
    );
  }
}
