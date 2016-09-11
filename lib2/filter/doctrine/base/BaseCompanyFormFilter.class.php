<?php

/**
 * Company filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCompanyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'profile_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => true)),
      'gallery_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => true)),
      'meta_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'     => new sfWidgetFormFilterInput(),
      'city'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'post_code'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'street'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'maps'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nip'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mobile'          => new sfWidgetFormFilterInput(),
      'fax'             => new sfWidgetFormFilterInput(),
      'www'             => new sfWidgetFormFilterInput(),
      'email_address'   => new sfWidgetFormFilterInput(),
      'gg'              => new sfWidgetFormFilterInput(),
      'skype'           => new sfWidgetFormFilterInput(),
      'yt'              => new sfWidgetFormFilterInput(),
      'fb'              => new sfWidgetFormFilterInput(),
      'packet'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rent_from'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'rent_to'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_paid'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'            => new sfWidgetFormFilterInput(),
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'type_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Type')),
      'email_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Email')),
    ));

    $this->setValidators(array(
      'profile_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profile'), 'column' => 'id')),
      'gallery_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Galleries'), 'column' => 'gallery_id')),
      'meta_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Metas'), 'column' => 'meta_id')),
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'city'            => new sfValidatorPass(array('required' => false)),
      'post_code'       => new sfValidatorPass(array('required' => false)),
      'street'          => new sfValidatorPass(array('required' => false)),
      'state'           => new sfValidatorPass(array('required' => false)),
      'maps'            => new sfValidatorPass(array('required' => false)),
      'nip'             => new sfValidatorPass(array('required' => false)),
      'phone'           => new sfValidatorPass(array('required' => false)),
      'mobile'          => new sfValidatorPass(array('required' => false)),
      'fax'             => new sfValidatorPass(array('required' => false)),
      'www'             => new sfValidatorPass(array('required' => false)),
      'email_address'   => new sfValidatorPass(array('required' => false)),
      'gg'              => new sfValidatorPass(array('required' => false)),
      'skype'           => new sfValidatorPass(array('required' => false)),
      'yt'              => new sfValidatorPass(array('required' => false)),
      'fb'              => new sfValidatorPass(array('required' => false)),
      'packet'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rent_from'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'rent_to'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_paid'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'            => new sfValidatorPass(array('required' => false)),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'type_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Type', 'required' => false)),
      'email_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Email', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('company_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('Company2Category.category_id', $values)
    ;
  }

  public function addTypeListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Company2Type Company2Type')
      ->andWhereIn('Company2Type.type_id', $values)
    ;
  }

  public function addEmailListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Stats Stats')
      ->andWhereIn('Stats.email_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Company';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'profile_id'      => 'ForeignKey',
      'gallery_id'      => 'ForeignKey',
      'meta_id'         => 'ForeignKey',
      'name'            => 'Text',
      'description'     => 'Text',
      'city'            => 'Text',
      'post_code'       => 'Text',
      'street'          => 'Text',
      'state'           => 'Text',
      'maps'            => 'Text',
      'nip'             => 'Text',
      'phone'           => 'Text',
      'mobile'          => 'Text',
      'fax'             => 'Text',
      'www'             => 'Text',
      'email_address'   => 'Text',
      'gg'              => 'Text',
      'skype'           => 'Text',
      'yt'              => 'Text',
      'fb'              => 'Text',
      'packet'          => 'Number',
      'rent_from'       => 'Date',
      'rent_to'         => 'Date',
      'is_paid'         => 'Boolean',
      'is_active'       => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'slug'            => 'Text',
      'categories_list' => 'ManyKey',
      'type_list'       => 'ManyKey',
      'email_list'      => 'ManyKey',
    );
  }
}
