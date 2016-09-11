<?php

/**
 * Company2Type form base class.
 *
 * @method Company2Type getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCompany2TypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'company_id' => new sfWidgetFormInputHidden(),
      'type_id'    => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'company_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('company_id')), 'empty_value' => $this->getObject()->get('company_id'), 'required' => false)),
      'type_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type_id')), 'empty_value' => $this->getObject()->get('type_id'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('company2_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Company2Type';
  }

}
