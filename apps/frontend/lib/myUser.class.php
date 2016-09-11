<?php

class myUser extends sfGuardSecurityUser
{
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::initialize($dispatcher, $storage, $options);

    if (!$this->isAuthenticated())
    {
      // remove user if timeout
      $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
      $this->user = null;
    }
    $this->setCulture('pl');
  }

  public function getComapny()
  {
      return $this->getProfile()->getCompany();
  }

  public function getInvoices()
  {
      return InvoiceTable::getInstance()->getInvoicesByUser($this->getProfile());
  }

  public function validateInvoice($invoice)
  {
      return InvoiceTable::getInstance()->getIsValidateInvoiceByUser($invoice, $this->getProfile());
  }
}
