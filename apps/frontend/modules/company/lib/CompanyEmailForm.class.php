<?php

class CompanyEmailForm extends sfForm
{
    
    private $company = false;
    
    public function setCompany($company)
    {
        $this->company = $company;
    }
    
    public function configure()
    {
        $this->disableCSRFProtection();
        $this->widgetSchema->setNameFormat('form[%s]');

        $this->widgetSchema['name'] = new sfWidgetFormInputText();
        $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
        $this->widgetSchema['name']->setDefault('Imię i nazwisko');
        $this->widgetSchema['name']->setLabel(false);
        
        $this->widgetSchema['phone'] = new sfWidgetFormInput();
        $this->validatorSchema['phone'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
        $this->widgetSchema['phone']->setDefault('Numer telefonu');
        $this->widgetSchema['phone']->setLabel(false);
        
        $this->widgetSchema['email'] = new sfWidgetFormInput();
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));
        $this->widgetSchema['email']->setDefault('Adres e-mail');
        $this->widgetSchema['email']->setLabel(false);

        $this->widgetSchema['text'] = new sfWidgetFormTextarea();
        $this->validatorSchema['text'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['text']->setDefault('Treść wiadomości...');
        $this->widgetSchema['text']->setLabel(false);
//
//        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
//        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator();
    }
    
    public function save()
    {
        $email = ($this->company->getEmailAddress()) ? $this->company->getEmailAddress() : $this->company->getProfile()->getGuardUser()->getEmailAddress();        

        $body = "{$this->getValue('text')}
<br /><br />
{$this->getValue('name')}<br />
{$this->getValue('phone')}<br />
{$this->getValue('email')}<br />
";

        $from = $this->getValue('email');

        T::systemMail($email, 'Wiadomość z serwisu oceanfirm.pl', $body, $from);
        
        $this->company->addStatsEmail($this->getValue('email'));
        
    }
    
}