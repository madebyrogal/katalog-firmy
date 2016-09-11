<?php

require_once dirname(__FILE__).'/../lib/pricesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pricesGeneratorHelper.class.php';

/**
 * prices actions.
 *
 * @package    sell4
 * @subpackage prices
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pricesActions extends autoPricesActions
{
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if($this->getRoute()->getObject()->getIsDeletable())
    {
        if ($this->getRoute()->getObject()->delete())
        {
          $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }
    }
    else
    {
        $this->getUser()->setFlash('error', 'Nie możesz usunąc tego pakietu');
    }

    $this->redirect('@prices');
  }
}
