<?php

/**
 * SliderBanners form base class.
 *
 * @method SliderBanners getObject() Returns the current form's model object
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSliderBannersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slider_banner_id' => new sfWidgetFormInputHidden(),
      'slider_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sliders'), 'add_empty' => false)),
      'name'             => new sfWidgetFormInputText(),
      'link'             => new sfWidgetFormInputText(),
      'user_banner_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'add_empty' => true)),
      'file'             => new sfWidgetFormTextarea(),
      'position'         => new sfWidgetFormInputText(),
      'target'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'slider_banner_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('slider_banner_id')), 'empty_value' => $this->getObject()->get('slider_banner_id'), 'required' => false)),
      'slider_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sliders'))),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'link'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_banner_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'required' => false)),
      'file'             => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'position'         => new sfValidatorInteger(array('required' => false)),
      'target'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('slider_banners[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SliderBanners';
  }

}
