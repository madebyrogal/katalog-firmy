<?php

/**
 * SearchIndex filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSearchIndexFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'model'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'model_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'keyword'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lang'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'model'    => new sfValidatorPass(array('required' => false)),
      'model_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'keyword'  => new sfValidatorPass(array('required' => false)),
      'lang'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('search_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchIndex';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'model'    => 'Text',
      'model_id' => 'Number',
      'keyword'  => 'Text',
      'lang'     => 'Text',
    );
  }
}
