<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'is_public'    => new sfWidgetFormInputCheckbox(),
      'meta_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'root_id'      => new sfWidgetFormInputText(),
      'lft'          => new sfWidgetFormInputText(),
      'rgt'          => new sfWidgetFormInputText(),
      'level'        => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormInputText(),
      'company_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Company')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'  => new sfValidatorString(array('required' => false)),
      'is_public'    => new sfValidatorBoolean(array('required' => false)),
      'meta_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'root_id'      => new sfValidatorInteger(array('required' => false)),
      'lft'          => new sfValidatorInteger(array('required' => false)),
      'rgt'          => new sfValidatorInteger(array('required' => false)),
      'level'        => new sfValidatorInteger(array('required' => false)),
      'slug'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'company_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Company', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Category', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['company_list']))
    {
      $this->setDefault('company_list', $this->object->Company->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCompanyList($con);

    parent::doSave($con);
  }

  public function saveCompanyList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['company_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Company->getPrimaryKeys();
    $values = $this->getValue('company_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Company', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Company', array_values($link));
    }
  }

}
