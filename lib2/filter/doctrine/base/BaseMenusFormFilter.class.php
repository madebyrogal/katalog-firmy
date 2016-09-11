<?php

/**
 * Menus filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMenusFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'menu_key'       => new sfWidgetFormFilterInput(),
      'lang'           => new sfWidgetFormFilterInput(),
      'url'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'target'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'route'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'model'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'object'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cssclass'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_banner_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserBanners'), 'add_empty' => true)),
      'is_active'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'root_id'        => new sfWidgetFormFilterInput(),
      'lft'            => new sfWidgetFormFilterInput(),
      'rgt'            => new sfWidgetFormFilterInput(),
      'level'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'title'          => new sfValidatorPass(array('required' => false)),
      'menu_key'       => new sfValidatorPass(array('required' => false)),
      'lang'           => new sfValidatorPass(array('required' => false)),
      'url'            => new sfValidatorPass(array('required' => false)),
      'target'         => new sfValidatorPass(array('required' => false)),
      'route'          => new sfValidatorPass(array('required' => false)),
      'model'          => new sfValidatorPass(array('required' => false)),
      'object'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cssclass'       => new sfValidatorPass(array('required' => false)),
      'user_banner_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserBanners'), 'column' => 'user_banner_id')),
      'is_active'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'root_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('menus_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menus';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'title'          => 'Text',
      'menu_key'       => 'Text',
      'lang'           => 'Text',
      'url'            => 'Text',
      'target'         => 'Text',
      'route'          => 'Text',
      'model'          => 'Text',
      'object'         => 'Number',
      'cssclass'       => 'Text',
      'user_banner_id' => 'ForeignKey',
      'is_active'      => 'Boolean',
      'root_id'        => 'Number',
      'lft'            => 'Number',
      'rgt'            => 'Number',
      'level'          => 'Number',
    );
  }
}
