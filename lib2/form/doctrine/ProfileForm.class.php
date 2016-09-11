<?php

/**
 * Profile form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends BaseProfileForm
{
  public function configure()
  {
      unset($this['created_at']);
      unset($this['updated_at']);

      $state = array();
      $state[''] = "[ Wybierz województwo ]";
      $state['dolnośląskie'] = "dolnośląskie";
      $state['kujawsko-pomorskie'] = "kujawsko-pomorskie";
      $state['lubelskie'] = "lubelskie";
      $state['lubuskie'] = "lubuskie";
      $state['łódzkie'] = "łódzkie";
      $state['małopolskie'] = "małopolskie";
      $state['mazowieckie'] = "mazowieckie";
      $state['opolskie'] = "opolskie";
      $state['podkarpackie'] = "podkarpackie";
      $state['podlaskie'] = "podlaskie";
      $state['pomorskie'] = "pomorskie";
      $state['śląskie'] = "śląskie";
      $state['świętokrzyskie'] = "świętokrzyskie";
      $state['warmińsko-mazurskie'] = "warmińsko-mazurskie";
      $state['wielkopolskie'] = "wielkopolskie";
      $state['zachodniopomorskie'] = "zachodniopomorskie";

      $this->widgetSchema['state'] = new sfWidgetFormChoice(
          array(
             'choices' => $state
          ));

      $this->widgetSchema['guard_user_id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['city']->setLabel('Miasto');
      $this->widgetSchema['post_code']->setLabel('Kod pocztowy');
      $this->widgetSchema['street']->setLabel('Ulica');
      $this->widgetSchema['state']->setLabel('Województwo');
      $this->widgetSchema['name']->setLabel('Nazwa firmy');
      $this->widgetSchema['phone']->setLabel('Telefon');
  }


}
