<?php

class UserFrontendForm extends sfGuardUserAdminForm
{
    public function configure()
    {

        parent::configure();

        //unset($this['username']);
        //unset($this['is_active']);
        unset($this['groups_list']);
        unset($this['permissions_list']);
        
        $this->widgetSchema['username'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['is_active'] = new sfWidgetFormInputHidden();
        
        $this->widgetSchema['first_name']->setLabel('Imię');
        $this->widgetSchema['last_name']->setLabel('Nazwisko');
        
        $this->widgetSchema['password']->setLabel('Hasło');
        $this->widgetSchema['password_again']->setLabel('Powtórz hasło');
        $this->widgetSchema['email_address']->setLabel('Adres e-mail');
        
    }

    public function save($con = null)
    {        
        $this->saveEmbeddedForms($con);
        parent::save($con);
    }
}