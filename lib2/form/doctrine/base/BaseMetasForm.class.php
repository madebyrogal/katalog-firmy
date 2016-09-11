<?php

/**
 * Metas form base class.
 *
 * @method Metas getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMetasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'meta_id'    => new sfWidgetFormInputHidden(),
      'is_default' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'meta_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('meta_id')), 'empty_value' => $this->getObject()->get('meta_id'), 'required' => false)),
      'is_default' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('metas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Metas';
  }

}
