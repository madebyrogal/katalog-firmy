<?php

/**
 * Stats form base class.
 *
 * @method Stats getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStatsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'email_id'   => new sfWidgetFormInputHidden(),
      'company_id' => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'email_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('email_id')), 'empty_value' => $this->getObject()->get('email_id'), 'required' => false)),
      'company_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('company_id')), 'empty_value' => $this->getObject()->get('company_id'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('stats[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stats';
  }

}
