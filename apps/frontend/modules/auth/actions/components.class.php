<?php
//require_once(dirname(__FILE__).'/../lib/RegisterForm.class.php');
require_once(dirname(__FILE__).'/../lib/LoginForm.class.php');

class authComponents extends sfComponents
{
    public function executeCompLoginForm() {
        $this->form = new LoginForm();
    }

    public function executeCompLoginLinks() {
      
    }
}
