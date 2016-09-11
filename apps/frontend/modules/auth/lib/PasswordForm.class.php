<?php
require_once dirname(__FILE__).'/RegisterForm.class.php';

class PasswordForm extends RegisterForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'password'   => new sfWidgetFormInputPassword(),
      'password2'  => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'password'   => new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128),
                        array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.')),
      'password2'  => new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128)),

    ));


    $this->widgetSchema->setNameFormat('PasswordForm[%s]');

    $this->setPasswordEqualValidator();

    stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
  }


  public function doSave($con = null)
  {
    $values = $this->getValues();

    $user = $this->getObject();
    if ($values['password']) {
      $user->setPassword($values['password']);
    }
    $user->save();

    return $user;
  }
}