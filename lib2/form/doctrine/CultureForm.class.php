<?php

/**
 * Culture form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CultureForm extends BaseCultureForm
{
  public function configure()
  {
    unset (
            $this['position'],
            $this['country'],
            $this['is_active'],
            $this['is_deleted']
            );

    if ($this->getObject()->isNew()) {
      $existing_langs =  Lang::getInstance()->getNotDeleted()->toArray();
      $this->widgetSchema['language'] = new sfWidgetFormChoice(array('choices' => Countries::retrieveAllLangsExcept($existing_langs)));
      $this->validatorSchema['language'] = new sfValidatorPass();
    }
  }

  public function doSave($con = null) {
    $culture = $this->getObject()->getTable()->find($this->getValue('language'));

    if ($culture) {
      // wersja językowa już istnieje, tylko ma flagę 'is_deleted' = true;
      $culture->merge($this->getValues());
      $culture->setIsDeleted(false);
      $culture->save();

    }
    else {
      $culture = new Culture();
      $culture->merge($this->getValues());
      $culture->save();
    }

    sfContext::getInstance()->getController()->redirect('@culture');

  }
}
