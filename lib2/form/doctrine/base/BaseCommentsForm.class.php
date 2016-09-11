<?php

/**
 * Comments form base class.
 *
 * @method Comments getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comment_id'     => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'content'        => new sfWidgetFormTextarea(),
      'author'         => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'articles_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'galleries_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Galleries')),
    ));

    $this->setValidators(array(
      'comment_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('comment_id')), 'empty_value' => $this->getObject()->get('comment_id'), 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'content'        => new sfValidatorString(),
      'author'         => new sfValidatorString(array('max_length' => 255)),
      'email'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'articles_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'galleries_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Galleries', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comments';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_list']))
    {
      $this->setDefault('articles_list', $this->object->Articles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['galleries_list']))
    {
      $this->setDefault('galleries_list', $this->object->Galleries->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesList($con);
    $this->saveGalleriesList($con);

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

  public function saveGalleriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['galleries_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Galleries->getPrimaryKeys();
    $values = $this->getValue('galleries_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Galleries', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Galleries', array_values($link));
    }
  }

}
