<?php

/**
 * UserBanners filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserBannersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'file'           => new sfWidgetFormFilterInput(),
      'is_active'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'link'           => new sfWidgetFormFilterInput(),
      'target'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'          => new sfValidatorPass(array('required' => false)),
      'file'           => new sfValidatorPass(array('required' => false)),
      'is_active'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'link'           => new sfValidatorPass(array('required' => false)),
      'target'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_banners_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserBanners';
  }

  public function getFields()
  {
    return array(
      'user_banner_id' => 'Number',
      'title'          => 'Text',
      'file'           => 'Text',
      'is_active'      => 'Boolean',
      'link'           => 'Text',
      'target'         => 'Text',
    );
  }
}
