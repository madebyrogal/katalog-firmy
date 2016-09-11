<?php
require_once dirname(__FILE__).'/RegisterForm.class.php';

class UserForm extends RegisterForm
{
  public function configure()
  {
    parent::configure();
    $this->getWidgetSchema()->setDefaults($this->object->getProfile()->DefaultInvoiceAddress->toArray());
    $this->getWidgetSchema()->setDefaults($this->object->getProfile()->toArray());
    $this->getWidget('email')->setDefault($this->object->getEmailAddress());

    $this->setValidator('password',
      new sfValidatorString(array('min_length' => 3, 'required' => false, 'trim' => true, 'max_length' => 128),
        array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.')
      )
    );
    $this->setValidator('password2',
      new sfValidatorString(array('min_length' => 3, 'required' => false, 'trim' => true, 'max_length' => 128),
        array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.')
      )
    );

    $this->setValidator('email', new sfValidatorAnd(array(
        new sfValidatorEmail(array('required' => true)),
        new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array($this->getObject()->getEmailAddress()))),
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address')), array('invalid' => 'Ten email jest już zajęty.'))
        ))
    )));

    unset($this['username']);
    
    stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
  }

  public function doSave($con = null)
  {
    $values = $this->getValues();

//    $user = new sfGuardUser();
    $user = $this->getObject();
    if ($values['password']) {
      $user->setPassword($values['password']);
    }
    $user->setEmailAddress($values['email']);
    $user->save();

    $user->Profile->DefaultInvoiceAddress->merge($values);
    $user->Profile->DefaultInvoiceAddress->save();


    $user->Profile->merge($values);
    $user->Profile->save();


    return $user;
  }
}