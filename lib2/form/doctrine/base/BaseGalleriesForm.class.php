<?php

/**
 * Galleries form base class.
 *
 * @method Galleries getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGalleriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gallery_id'         => new sfWidgetFormInputHidden(),
      'meta_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'add_empty' => true)),
      'default_picture_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultPicture'), 'add_empty' => true)),
      'is_deletable'       => new sfWidgetFormInputCheckbox(),
      'is_editable'        => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'articles_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
      'comments_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Comments')),
    ));

    $this->setValidators(array(
      'gallery_id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gallery_id')), 'empty_value' => $this->getObject()->get('gallery_id'), 'required' => false)),
      'meta_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Metas'), 'required' => false)),
      'default_picture_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultPicture'), 'required' => false)),
      'is_deletable'       => new sfValidatorBoolean(array('required' => false)),
      'is_editable'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'articles_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
      'comments_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Comments', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Galleries', 'column' => array('default_picture_id')))
    );

    $this->widgetSchema->setNameFormat('galleries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Galleries';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_list']))
    {
      $this->setDefault('articles_list', $this->object->Articles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['comments_list']))
    {
      $this->setDefault('comments_list', $this->object->Comments->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesList($con);
    $this->saveCommentsList($con);

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

  public function saveCommentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['comments_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Comments->getPrimaryKeys();
    $values = $this->getValue('comments_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Comments', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Comments', array_values($link));
    }
  }

}
