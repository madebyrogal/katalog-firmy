<?php

/**
 * Tag filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'record_key'    => new sfWidgetFormFilterInput(),
      'lang'          => new sfWidgetFormFilterInput(),
      'slug'          => new sfWidgetFormFilterInput(),
      'articles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'record_key'    => new sfValidatorPass(array('required' => false)),
      'lang'          => new sfValidatorPass(array('required' => false)),
      'slug'          => new sfValidatorPass(array('required' => false)),
      'articles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.Article2Tag Article2Tag')
      ->andWhereIn('Article2Tag.article_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'record_key'    => 'Text',
      'lang'          => 'Text',
      'slug'          => 'Text',
      'articles_list' => 'ManyKey',
    );
  }
}
