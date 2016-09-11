<?php
require_once dirname(__FILE__).'/RegisterForm.class.php';

class UserAddressForm extends AddressForm
{
  public function configure()
  {
    parent::configure();

    unset(
        $this['region'],
        $this['country'],
        $this['house_no'],
        $this['flat_no'],
      $this['profile_id'],
      $this['nip'],
      $this['regon'],
      $this['created_at'],
      $this['updated_at']
    );

    stgFormFormatter::setFormatter($this->widgetSchema, $this->validatorSchema);
  }

}