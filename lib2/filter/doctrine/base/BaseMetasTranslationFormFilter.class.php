<?php

/**
 * MetasTranslation filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMetasTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'generate'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'title'        => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'keywords'     => new sfWidgetFormFilterInput(),
      'copyright'    => new sfWidgetFormFilterInput(),
      'author'       => new sfWidgetFormFilterInput(),
      'email'        => new sfWidgetFormFilterInput(),
      'distribution' => new sfWidgetFormFilterInput(),
      'rating'       => new sfWidgetFormFilterInput(),
      'robots'       => new sfWidgetFormFilterInput(),
      'revisitafter' => new sfWidgetFormFilterInput(),
      'expires'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'generate'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'title'        => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'keywords'     => new sfValidatorPass(array('required' => false)),
      'copyright'    => new sfValidatorPass(array('required' => false)),
      'author'       => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'distribution' => new sfValidatorPass(array('required' => false)),
      'rating'       => new sfValidatorPass(array('required' => false)),
      'robots'       => new sfValidatorPass(array('required' => false)),
      'revisitafter' => new sfValidatorPass(array('required' => false)),
      'expires'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('metas_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MetasTranslation';
  }

  public function getFields()
  {
    return array(
      'meta_id'      => 'Number',
      'generate'     => 'Boolean',
      'title'        => 'Text',
      'description'  => 'Text',
      'keywords'     => 'Text',
      'copyright'    => 'Text',
      'author'       => 'Text',
      'email'        => 'Text',
      'distribution' => 'Text',
      'rating'       => 'Text',
      'robots'       => 'Text',
      'revisitafter' => 'Text',
      'expires'      => 'Text',
      'lang'         => 'Text',
    );
  }
}
