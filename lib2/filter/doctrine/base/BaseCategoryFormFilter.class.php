<?php

/**
 * Category filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'is_public'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'meta_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'root_id'      => new sfWidgetFormFilterInput(),
      'lft'          => new sfWidgetFormFilterInput(),
      'rgt'          => new sfWidgetFormFilterInput(),
      'level'        => new sfWidgetFormFilterInput(),
      'slug'         => new sfWidgetFormFilterInput(),
      'company_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Company')),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'is_public'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'meta_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Metas'), 'column' => 'meta_id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'root_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'         => new sfValidatorPass(array('required' => false)),
      'company_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Company', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCompanyListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Company2Category Company2Category')
      ->andWhereIn('Company2Category.company_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'description'  => 'Text',
      'is_public'    => 'Boolean',
      'meta_id'      => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'root_id'      => 'Number',
      'lft'          => 'Number',
      'rgt'          => 'Number',
      'level'        => 'Number',
      'slug'         => 'Text',
      'company_list' => 'ManyKey',
    );
  }
}
