<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

class sfGuardUserActions extends autoSfGuardUserActions
{
  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->isEditable()) {
      parent::executeEdit($request);
    }
    else {
      $this->redirect($request->getReferer());
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->isEditable()) {
      parent::executeUpdate($request);
    }
    else {
      $this->redirect($request->getReferer());
    }
  }

  public function executeDelete(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->isDeletable()) {
      parent::executeDelete($request);
    }
    else {
      $this->redirect($request->getReferer());
    }
  }

}
