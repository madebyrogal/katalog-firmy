<?php

/**
 * OrderVersion form base class.
 *
 * @method OrderVersion getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'uid'          => new sfWidgetFormInputText(),
      'profile_id'   => new sfWidgetFormInputText(),
      'company_id'   => new sfWidgetFormInputText(),
      'status_id'    => new sfWidgetFormInputText(),
      'note'         => new sfWidgetFormTextarea(),
      'invoice_id'   => new sfWidgetFormInputText(),
      'value_netto'  => new sfWidgetFormInputText(),
      'value_brutto' => new sfWidgetFormInputText(),
      'rent_from'    => new sfWidgetFormDateTime(),
      'rent_to'      => new sfWidgetFormDateTime(),
      'is_paid'      => new sfWidgetFormInputCheckbox(),
      'packet'       => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'uid'          => new sfValidatorString(array('max_length' => 255)),
      'profile_id'   => new sfValidatorInteger(),
      'company_id'   => new sfValidatorInteger(),
      'status_id'    => new sfValidatorString(array('max_length' => 255)),
      'note'         => new sfValidatorString(array('required' => false)),
      'invoice_id'   => new sfValidatorInteger(array('required' => false)),
      'value_netto'  => new sfValidatorInteger(),
      'value_brutto' => new sfValidatorInteger(),
      'rent_from'    => new sfValidatorDateTime(array('required' => false)),
      'rent_to'      => new sfValidatorDateTime(array('required' => false)),
      'is_paid'      => new sfValidatorBoolean(array('required' => false)),
      'packet'       => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'version'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderVersion';
  }

}
