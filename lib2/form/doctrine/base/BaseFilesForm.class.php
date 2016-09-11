<?php

/**
 * Files form base class.
 *
 * @method Files getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFilesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file_id'       => new sfWidgetFormInputHidden(),
      'file'          => new sfWidgetFormTextarea(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'root_id'       => new sfWidgetFormInputText(),
      'lft'           => new sfWidgetFormInputText(),
      'rgt'           => new sfWidgetFormInputText(),
      'level'         => new sfWidgetFormInputText(),
      'articles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
    ));

    $this->setValidators(array(
      'file_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('file_id')), 'empty_value' => $this->getObject()->get('file_id'), 'required' => false)),
      'file'          => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'root_id'       => new sfValidatorInteger(array('required' => false)),
      'lft'           => new sfValidatorInteger(array('required' => false)),
      'rgt'           => new sfValidatorInteger(array('required' => false)),
      'level'         => new sfValidatorInteger(array('required' => false)),
      'articles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('files[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Files';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_list']))
    {
      $this->setDefault('articles_list', $this->object->Articles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesList($con);

    parent::doSave($con);
  }

  public function saveArticlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['articles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Articles->getPrimaryKeys();
    $values = $this->getValue('articles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Articles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Articles', array_values($link));
    }
  }

}
