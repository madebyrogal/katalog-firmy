<?php

/**
 * Company form base class.
 *
 * @method Company getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCompanyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'profile_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => true)),
      'gallery_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'add_empty' => true)),
      'meta_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'name'            => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'city'            => new sfWidgetFormInputText(),
      'post_code'       => new sfWidgetFormInputText(),
      'street'          => new sfWidgetFormInputText(),
      'state'           => new sfWidgetFormInputText(),
      'maps'            => new sfWidgetFormTextarea(),
      'nip'             => new sfWidgetFormInputText(),
      'phone'           => new sfWidgetFormInputText(),
      'mobile'          => new sfWidgetFormInputText(),
      'fax'             => new sfWidgetFormInputText(),
      'www'             => new sfWidgetFormInputText(),
      'email_address'   => new sfWidgetFormInputText(),
      'gg'              => new sfWidgetFormInputText(),
      'skype'           => new sfWidgetFormInputText(),
      'yt'              => new sfWidgetFormInputText(),
      'fb'              => new sfWidgetFormInputText(),
      'packet'          => new sfWidgetFormInputText(),
      'rent_from'       => new sfWidgetFormDateTime(),
      'rent_to'         => new sfWidgetFormDateTime(),
      'is_paid'         => new sfWidgetFormInputCheckbox(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'slug'            => new sfWidgetFormInputText(),
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'type_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Type')),
      'email_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Email')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'profile_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'required' => false)),
      'gallery_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Galleries'), 'required' => false)),
      'meta_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'description'     => new sfValidatorString(array('required' => false)),
      'city'            => new sfValidatorString(array('max_length' => 255)),
      'post_code'       => new sfValidatorString(array('max_length' => 255)),
      'street'          => new sfValidatorString(array('max_length' => 255)),
      'state'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'maps'            => new sfValidatorString(array('required' => false)),
      'nip'             => new sfValidatorString(array('max_length' => 255)),
      'phone'           => new sfValidatorString(array('max_length' => 255)),
      'mobile'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fax'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'www'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_address'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'gg'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'skype'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'yt'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fb'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'packet'          => new sfValidatorInteger(array('required' => false)),
      'rent_from'       => new sfValidatorDateTime(array('required' => false)),
      'rent_to'         => new sfValidatorDateTime(array('required' => false)),
      'is_paid'         => new sfValidatorBoolean(array('required' => false)),
      'is_active'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'slug'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'type_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Type', 'required' => false)),
      'email_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Email', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Company', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('company[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Company';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories_list']))
    {
      $this->setDefault('categories_list', $this->object->Categories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['type_list']))
    {
      $this->setDefault('type_list', $this->object->Type->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['email_list']))
    {
      $this->setDefault('email_list', $this->object->Email->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCategoriesList($con);
    $this->saveTypeList($con);
    $this->saveEmailList($con);

    parent::doSave($con);
  }

  public function saveCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Categories->getPrimaryKeys();
    $values = $this->getValue('categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Categories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Categories', array_values($link));
    }
  }

  public function saveTypeList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['type_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Type->getPrimaryKeys();
    $values = $this->getValue('type_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Type', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Type', array_values($link));
    }
  }

  public function saveEmailList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['email_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Email->getPrimaryKeys();
    $values = $this->getValue('email_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Email', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Email', array_values($link));
    }
  }

}
