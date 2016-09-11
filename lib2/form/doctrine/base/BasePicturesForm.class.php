<?php

/**
 * Pictures form base class.
 *
 * @method Pictures getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePicturesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'picture_id'       => new sfWidgetFormInputHidden(),
      'gallery_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => false)),
      'erp_zd_zdjecieid' => new sfWidgetFormInputText(),
      'file'             => new sfWidgetFormInputText(),
      'rate_sum'         => new sfWidgetFormInputText(),
      'rate_hits'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'picture_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('picture_id')), 'empty_value' => $this->getObject()->get('picture_id'), 'required' => false)),
      'gallery_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'))),
      'erp_zd_zdjecieid' => new sfValidatorInteger(array('required' => false)),
      'file'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rate_sum'         => new sfValidatorInteger(array('required' => false)),
      'rate_hits'        => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pictures[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pictures';
  }

}
