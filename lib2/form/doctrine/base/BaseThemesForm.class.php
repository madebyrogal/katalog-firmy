<?php

/**
 * Themes form base class.
 *
 * @method Themes getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThemesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'creation_date' => new sfWidgetFormDate(),
      'author'        => new sfWidgetFormInputText(),
      'author_email'  => new sfWidgetFormInputText(),
      'author_url'    => new sfWidgetFormInputText(),
      'copyright'     => new sfWidgetFormInputText(),
      'version'       => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'creation_date' => new sfValidatorDate(array('required' => false)),
      'author'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_email'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_url'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'copyright'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'version'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('themes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Themes';
  }

}
