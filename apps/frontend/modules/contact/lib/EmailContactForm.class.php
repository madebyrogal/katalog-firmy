<?php

class EmailContactForm extends sfForm
{
    public function configure()
    {
        $this->disableCSRFProtection();
        $this->widgetSchema->setNameFormat('form[%s]');

        $this->widgetSchema['name'] = new sfWidgetFormInputText();
        $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
        
        $this->widgetSchema['email'] = new sfWidgetFormInput();
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));

        $this->widgetSchema['text'] = new sfWidgetFormTextarea();
        $this->validatorSchema['text'] = new sfValidatorString(array('required' => true));

        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator();
    }

    public function save()
    {
        // rekord modelu Contact
        $contact = Doctrine::getTable('Contact')->createQuery()->execute()->getFirst();

        $body = "{$this->getValue('text')}
<br /><br />
{$this->getValue('name')}<br />
{$this->getValue('email')}
";

        $from = $this->getValue('email');
        //echo Contact::getContactEmail();
        T::systemMail(Contact::getContactEmail(), $contact->getMessageTitle(), $body, $from);
    }

    /**
     * Dodaje do wiadomości wielu odbiorców na podstawie stringa z adresami email rozdzielonymi seperatorem
     */
    private function getMessageWithMultipleRecipients($message, $emails_string, $separator = ',')
    {
        $emails = explode($separator, $emails_string);
        foreach ($emails as $email)
        {
            $email = trim($email);
            if(isset($email) && !empty($email))
            {
                $message->addTo($email);
            }
        }

        return $message;
    }
}