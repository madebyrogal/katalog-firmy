<?php
class RegisterOpenidForm extends RegisterForm
{
  private $required = '<span style="color: #ff0000;">*</span> ';

  public function configure()
  {
    unset(
          $this['email'],
          $this['username'],
          $this['password'],
          $this['password2']
          );

    $this->setWidgets(array(
      'name'       => new sfWidgetFormInputText(),

      'phone'      => new sfWidgetFormInputText(),
      'street'     => new sfWidgetFormInputText(),
//      'house_no'   => new sfWidgetFormInputText(),
//      'flat_no'    => new sfWidgetFormInputText(),
      'post_code'  => new sfWidgetFormInputText(),
      'city'       => new sfWidgetFormInputText(),
//      'region'     => new sfWidgetFormInputText(),
//      'country'    => new sfWidgetFormInputText(),

      'nip'        => new sfWidgetFormInputText(),
//      'regon'      => new sfWidgetFormInputText(),

//      'gadugadu'   => new sfWidgetFormInputText(),
//      'skype'      => new sfWidgetFormInputText(),
//      'www'        => new sfWidgetFormInputText()
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorString(array('min_length' => 1, 'max_length' => 255, 'trim' => true, 'required' => true, )),

      'phone'      => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'street'     => new sfValidatorString(array('max_length' => 127, 'required' => true)),
      'house_no'   => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'flat_no'    => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'post_code'  => new sfValidatorString(array('max_length' => 127, 'required' => true)),
      'city'       => new sfValidatorString(array('max_length' => 127, 'required' => true)),
      'region'     => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 127, 'required' => false)),

      'nip'        => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'regon'      => new sfValidatorString(array('max_length' => 127, 'required' => false)),

      'gadugadu'   => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'skype'      => new sfValidatorString(array('max_length' => 127, 'required' => false)),
      'www'        => new sfValidatorString(array('max_length' => 127, 'required' => false)),
    ));


    $this->widgetSchema->setNameFormat('RegisterForm[%s]');

    stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
  }

  public function doSave($con = null)
  {
    $myUser = sfContext::getInstance()->getUser();

    $values = $this->getValues();

    $user = new sfGuardUser();
    $user->setUsername($myUser->getAttribute('openid_email'));
    $user->setPassword(T::generateRandomKey(10));
    $user->setEmailAddress($myUser->getAttribute('openid_email'));
    $user->setIsActive(true);
    $user->addGroupByName('Klienci');
    $user->save();

    $user->Profile->DefaultInvoiceAddress->merge($values);
    $user->Profile->DefaultInvoiceAddress->save();

    $user->Profile->merge($values);
    $user->Profile->save();

    return $user;
  }
}