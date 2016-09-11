<?php

/**
 * Pictures filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePicturesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gallery_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => true)),
      'erp_zd_zdjecieid' => new sfWidgetFormFilterInput(),
      'file'             => new sfWidgetFormFilterInput(),
      'rate_sum'         => new sfWidgetFormFilterInput(),
      'rate_hits'        => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'gallery_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Galleries'), 'column' => 'gallery_id')),
      'erp_zd_zdjecieid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'file'             => new sfValidatorPass(array('required' => false)),
      'rate_sum'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rate_hits'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pictures_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pictures';
  }

  public function getFields()
  {
    return array(
      'picture_id'       => 'Number',
      'gallery_id'       => 'ForeignKey',
      'erp_zd_zdjecieid' => 'Number',
      'file'             => 'Text',
      'rate_sum'         => 'Number',
      'rate_hits'        => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
