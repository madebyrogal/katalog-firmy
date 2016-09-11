<?php

/**
 * Files filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFilesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'          => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'root_id'       => new sfWidgetFormFilterInput(),
      'lft'           => new sfWidgetFormFilterInput(),
      'rgt'           => new sfWidgetFormFilterInput(),
      'level'         => new sfWidgetFormFilterInput(),
      'articles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
    ));

    $this->setValidators(array(
      'file'          => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'root_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'articles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('files_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.ArticleFile ArticleFile')
      ->andWhereIn('ArticleFile.file_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Files';
  }

  public function getFields()
  {
    return array(
      'file_id'       => 'Number',
      'file'          => 'Text',
      'is_active'     => 'Boolean',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'root_id'       => 'Number',
      'lft'           => 'Number',
      'rgt'           => 'Number',
      'level'         => 'Number',
      'articles_list' => 'ManyKey',
    );
  }
}
