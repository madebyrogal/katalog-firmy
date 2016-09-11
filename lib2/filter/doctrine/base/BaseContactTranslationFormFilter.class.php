<?php

/**
 * ContactTranslation filter form base class.
 *
 * @package    sell4
 * @subpackage filter
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContactTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'message_title'    => new sfWidgetFormFilterInput(),
      'address'          => new sfWidgetFormFilterInput(),
      'map_address'      => new sfWidgetFormFilterInput(),
      'map_localization' => new sfWidgetFormFilterInput(),
      'form_email'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'message_title'    => new sfValidatorPass(array('required' => false)),
      'address'          => new sfValidatorPass(array('required' => false)),
      'map_address'      => new sfValidatorPass(array('required' => false)),
      'map_localization' => new sfValidatorPass(array('required' => false)),
      'form_email'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactTranslation';
  }

  public function getFields()
  {
    return array(
      'contact_id'       => 'Number',
      'message_title'    => 'Text',
      'address'          => 'Text',
      'map_address'      => 'Text',
      'map_localization' => 'Text',
      'form_email'       => 'Text',
      'lang'             => 'Text',
    );
  }
}
