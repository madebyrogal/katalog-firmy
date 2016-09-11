<?php

class CheckListContact extends CheckListTask 
{
    
    public function __construct($task = false)
    {
        $this->class_name = "CheckListContact";
        if($task)
        {
            $this->object = $task;
        }
    }

    public function valid()
    {
//        $contact = ContactTable::getInstance()->find(1);
        $contact = ContactTable::getInstance()->getFirst();

        $address = $contact->getAddress();
        if(strip_tags($address) == 'Dane teleadresowe')
        {
            return false;
        }

        $emails = explode(',',$contact->getFormEmail());
        foreach($emails as $email)
        {
            $email = trim($email);
            if($email == 'mailer@studiotg.pl' || !isset($email) || !Tools::checkEmail($email))
            {
                return false;
            }
        }        

        $this->setDone();
        return true;
        
    }

    public function getUrl()
    {
        return T::url_for('contact');
    }
    
}