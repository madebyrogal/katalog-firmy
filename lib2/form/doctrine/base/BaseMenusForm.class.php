<?php

/**
 * Menus form base class.
 *
 * @method Menus getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMenusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'title'          => new sfWidgetFormInputText(),
      'menu_key'       => new sfWidgetFormInputText(),
      'lang'           => new sfWidgetFormInputText(),
      'url'            => new sfWidgetFormTextarea(),
      'target'         => new sfWidgetFormInputText(),
      'route'          => new sfWidgetFormTextarea(),
      'model'          => new sfWidgetFormTextarea(),
      'object'         => new sfWidgetFormInputText(),
      'cssclass'       => new sfWidgetFormInputText(),
      'user_banner_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'add_empty' => true)),
      'is_active'      => new sfWidgetFormInputCheckbox(),
      'root_id'        => new sfWidgetFormInputText(),
      'lft'            => new sfWidgetFormInputText(),
      'rgt'            => new sfWidgetFormInputText(),
      'level'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'menu_key'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'            => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'target'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'route'          => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'model'          => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'object'         => new sfValidatorInteger(array('required' => false)),
      'cssclass'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_banner_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'required' => false)),
      'is_active'      => new sfValidatorBoolean(array('required' => false)),
      'root_id'        => new sfValidatorInteger(array('required' => false)),
      'lft'            => new sfValidatorInteger(array('required' => false)),
      'rgt'            => new sfValidatorInteger(array('required' => false)),
      'level'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menus';
  }

}
