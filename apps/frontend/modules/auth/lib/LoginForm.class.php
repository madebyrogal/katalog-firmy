<?php
class LoginForm extends sfGuardFormSignin
{

    public function configure()
    {
      $this->widgetSchema['username']->setLabel('Login lub E-mail');
      $this->widgetSchema['password']->setLabel('Hasło');
      $this->widgetSchema['remember']->setLabel('Zapamiętaj');

      stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
    }

}