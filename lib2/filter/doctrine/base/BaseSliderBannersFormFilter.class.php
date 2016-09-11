<?php

/**
 * SliderBanners filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSliderBannersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slider_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sliders'), 'add_empty' => true)),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'link'             => new sfWidgetFormFilterInput(),
      'user_banner_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'add_empty' => true)),
      'file'             => new sfWidgetFormFilterInput(),
      'position'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'target'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'slider_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sliders'), 'column' => 'slider_id')),
      'name'             => new sfValidatorPass(array('required' => false)),
      'link'             => new sfValidatorPass(array('required' => false)),
      'user_banner_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserBanners'), 'column' => 'user_banner_id')),
      'file'             => new sfValidatorPass(array('required' => false)),
      'position'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'target'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('slider_banners_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SliderBanners';
  }

  public function getFields()
  {
    return array(
      'slider_banner_id' => 'Number',
      'slider_id'        => 'ForeignKey',
      'name'             => 'Text',
      'link'             => 'Text',
      'user_banner_id'   => 'ForeignKey',
      'file'             => 'Text',
      'position'         => 'Number',
      'target'           => 'Text',
    );
  }
}
