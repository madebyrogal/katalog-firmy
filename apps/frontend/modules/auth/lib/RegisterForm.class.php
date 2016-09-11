<?php
class RegisterForm extends sfGuardUserForm
{
  private $required = '<span style="color: #ff0000;">*</span> ';

  public function configure()
  {
    $this->setWidgets(array(
      'email'      => new sfWidgetFormInputText(),
      'username'   => new sfWidgetFormInputText(),

      'password'   => new sfWidgetFormInputPassword(),
      'password2'  => new sfWidgetFormInputPassword(),

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
      'email'      => new sfValidatorAnd(array(
                        new sfValidatorEmail(array('trim' => true, 'required' => true),
                          array('invalid' => 'Wpisz poprawny adres e-mail.')),
                        new sfValidatorString(array('min_length' => 3, 'max_length' => 127, 'trim' => true, 'required' => true, )),
                        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'email_address'),
                          array('invalid' => 'Taki email jest już zajęty'))
                      )),
        
      'username'   => new sfValidatorAnd(array(
                        new sfValidatorString(array('min_length' => 3, 'max_length' => 127, 'trim' => true, 'required' => true, )),
                        new sfValidatorRegex(array('pattern' => '/^\w+$/'),
                          array('invalid' => 'Login może zawierać tylko litery, cyfry i podkreślenia.')),
                        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'username'),
                          array('invalid' => 'Taki login jest już zajęty'))
                      )),

      'password'   => new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128),
                        array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.')),
      'password2'  => new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128)),

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


    $this->setPasswordEqualValidator();

    $this->widgetSchema->setNameFormat('RegisterForm[%s]');


    $this->widgetSchema['email']->setLabel($this->required.'Email');
    $this->widgetSchema['username']->setLabel($this->required.'Login');
    $this->widgetSchema['password']->setLabel($this->required.'Hasło');
    $this->widgetSchema['password2']->setLabel($this->required.'Powtórz hasło');
    $this->widgetSchema['name']->setLabel($this->required.'Imię i nazwisko lub nazwa firmy');
    $this->widgetSchema['street']->setLabel($this->required.'Ulica');
    $this->widgetSchema['post_code']->setLabel($this->required.'Kod pocztowy');
    $this->widgetSchema['city']->setLabel($this->required.'Miasto');

    stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
  }

  protected function setPasswordEqualValidator() {
    $schema = $this->validatorSchema;
    $postValidator = $schema->getPostValidator();

    $postValidators = array(
      new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password2', array(),
        array('invalid' => 'Hasła muszą być jednakowe.')
      ),
    );

    if ($postValidator) {
      $postValidators[] = $postValidator;
    }

    $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));
  }

  public function doSave($con = null)
  {
    $values = $this->getValues();

    $user = new sfGuardUser();
    $user->setUsername($values['username']);
    $user->setPassword($values['password']);
    $user->setEmailAddress($values['email']);
    $user->addGroupByName('Klienci');
    $user->save();

    $user->Profile->DefaultInvoiceAddress->merge($values);
    $user->Profile->DefaultInvoiceAddress->save();

    $user->Profile->merge($values);
    $user->Profile->save();

    return $user;
  }
}