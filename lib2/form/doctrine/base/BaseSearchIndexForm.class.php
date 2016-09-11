<?php

/**
 * SearchIndex form base class.
 *
 * @method SearchIndex getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSearchIndexForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'model'    => new sfWidgetFormInputText(),
      'model_id' => new sfWidgetFormInputText(),
      'keyword'  => new sfWidgetFormInputText(),
      'lang'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'model'    => new sfValidatorString(array('max_length' => 255)),
      'model_id' => new sfValidatorInteger(),
      'keyword'  => new sfValidatorString(array('max_length' => 255)),
      'lang'     => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('search_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchIndex';
  }

}
