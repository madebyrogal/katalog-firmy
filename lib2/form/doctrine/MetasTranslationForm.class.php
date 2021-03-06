<?php

/**
 * MetasTranslation form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetasTranslationForm extends BaseMetasTranslationForm
{
  public function configure()
  {
    unset(
            $this['meta_id'],
            $this['author']
    );

    $this->widgetSchema['title'] = new sfWidgetFormInputText(array(
                'label' => 'Tytuł'
            ));

    $this->widgetSchema['description'] = new sfWidgetFormInputText(array(
                'label' => 'Opis strony'
            ));

    $this->widgetSchema['keywords'] = new sfWidgetFormInputText(array(
                'label' => 'Słowa kluczowe'
            ));
  }
}
