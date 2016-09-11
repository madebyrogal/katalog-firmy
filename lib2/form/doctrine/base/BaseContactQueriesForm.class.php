<?php

/**
 * ContactQueries form base class.
 *
 * @method ContactQueries getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactQueriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'query_id'   => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'phone'      => new sfWidgetFormInputText(),
      'query'      => new sfWidgetFormTextarea(),
      'file'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'query_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('query_id')), 'empty_value' => $this->getObject()->get('query_id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'query'      => new sfValidatorString(array('required' => false)),
      'file'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contact_queries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactQueries';
  }

}
