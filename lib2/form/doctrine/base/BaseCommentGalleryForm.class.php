<?php

/**
 * CommentGallery form base class.
 *
 * @method CommentGallery getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentGalleryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comment_id' => new sfWidgetFormInputHidden(),
      'gallery_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'comment_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('comment_id')), 'empty_value' => $this->getObject()->get('comment_id'), 'required' => false)),
      'gallery_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gallery_id')), 'empty_value' => $this->getObject()->get('gallery_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comment_gallery[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommentGallery';
  }

}
