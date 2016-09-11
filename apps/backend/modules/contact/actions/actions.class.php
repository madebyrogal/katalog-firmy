<?php

require_once dirname(__FILE__) . '/../lib/contactGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contactGeneratorHelper.class.php';

/**
 * contact actions.
 *
 * @package    stgcms2
 * @subpackage contact
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends autoContactActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@edit_default_contact');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirect('@edit_default_contact');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->redirect('@edit_default_contact');
  }

  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getPrimaryKey() != 1)
    {
      $this->redirect('@edit_default_contact');
    }
    else
    {
      parent::executeEdit($request);
    }
  }

}
