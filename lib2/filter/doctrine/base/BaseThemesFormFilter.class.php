<?php

/**
 * Themes filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThemesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'creation_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'author'        => new sfWidgetFormFilterInput(),
      'author_email'  => new sfWidgetFormFilterInput(),
      'author_url'    => new sfWidgetFormFilterInput(),
      'copyright'     => new sfWidgetFormFilterInput(),
      'version'       => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'creation_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'author'        => new sfValidatorPass(array('required' => false)),
      'author_email'  => new sfValidatorPass(array('required' => false)),
      'author_url'    => new sfValidatorPass(array('required' => false)),
      'copyright'     => new sfValidatorPass(array('required' => false)),
      'version'       => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('themes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Themes';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'is_active'     => 'Boolean',
      'creation_date' => 'Date',
      'author'        => 'Text',
      'author_email'  => 'Text',
      'author_url'    => 'Text',
      'copyright'     => 'Text',
      'version'       => 'Text',
      'description'   => 'Text',
    );
  }
}
