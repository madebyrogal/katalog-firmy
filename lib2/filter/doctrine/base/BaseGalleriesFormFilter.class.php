<?php

/**
 * Galleries filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGalleriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'meta_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'default_picture_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultPicture'), 'add_empty' => true)),
      'is_deletable'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_editable'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'articles_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'comments_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Comments')),
    ));

    $this->setValidators(array(
      'meta_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Metas'), 'column' => 'meta_id')),
      'default_picture_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DefaultPicture'), 'column' => 'picture_id')),
      'is_deletable'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_editable'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'articles_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'comments_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Comments', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('galleries_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.ArticleGallery ArticleGallery')
      ->andWhereIn('ArticleGallery.article_id', $values)
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
      ->leftJoin($query->getRootAlias().'.CommentGallery CommentGallery')
      ->andWhereIn('CommentGallery.comment_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Galleries';
  }

  public function getFields()
  {
    return array(
      'gallery_id'         => 'Number',
      'meta_id'            => 'ForeignKey',
      'default_picture_id' => 'ForeignKey',
      'is_deletable'       => 'Boolean',
      'is_editable'        => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'articles_list'      => 'ManyKey',
      'comments_list'      => 'ManyKey',
    );
  }
}
