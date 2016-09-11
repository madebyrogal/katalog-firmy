<?php

class myUser extends sfGuardSecurityUser
{
  public function  initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()) {
    parent::initialize($dispatcher, $storage, $options);

    if (! stgConfig::get('translations_enabled')) {
      $this->removeCredential('cultures');
      $this->removeCredential('culture_allow');
    }         

  }
}
