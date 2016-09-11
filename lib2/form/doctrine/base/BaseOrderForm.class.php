<?php

/**
 * Order form base class.
 *
 * @method Order getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'uid'          => new sfWidgetFormInputText(),
      'profile_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => false)),
      'company_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Company'), 'add_empty' => false)),
      'status_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => false)),
      'note'         => new sfWidgetFormTextarea(),
      'invoice_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'add_empty' => true)),
      'value_netto'  => new sfWidgetFormInputText(),
      'value_brutto' => new sfWidgetFormInputText(),
      'rent_from'    => new sfWidgetFormDateTime(),
      'rent_to'      => new sfWidgetFormDateTime(),
      'is_paid'      => new sfWidgetFormInputCheckbox(),
      'packet'       => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'uid'          => new sfValidatorString(array('max_length' => 255)),
      'profile_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'))),
      'company_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Company'))),
      'status_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'))),
      'note'         => new sfValidatorString(array('required' => false)),
      'invoice_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'required' => false)),
      'value_netto'  => new sfValidatorInteger(),
      'value_brutto' => new sfValidatorInteger(),
      'rent_from'    => new sfValidatorDateTime(array('required' => false)),
      'rent_to'      => new sfValidatorDateTime(array('required' => false)),
      'is_paid'      => new sfValidatorBoolean(array('required' => false)),
      'packet'       => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'version'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Order', 'column' => array('uid')))
    );

    $this->widgetSchema->setNameFormat('order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }

}
