<?php

require_once dirname(__FILE__).'/../lib/messageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/messageGeneratorHelper.class.php';

/**
 * message actions.
 *
 * @package    stgcms2
 * @subpackage message
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class messageActions extends autoMessageActions
{
  public function executeIndex(sfWebRequest $request)
  {
    //tworzenie domyslnych Message, jeśli jeszcze nie istnieją
    Message::getOrCreateDefaultMessage('mail_order');
    Message::getOrCreateDefaultMessage('summary_order');
    Message::getOrCreateDefaultMessage('payable_success');
    Message::getOrCreateDefaultMessage('payable_error');
    Message::getOrCreateDefaultMessage('admin_order');

    parent::executeIndex($request);
  }
}
