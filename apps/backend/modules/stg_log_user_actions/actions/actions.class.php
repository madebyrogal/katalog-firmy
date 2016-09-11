<?php

require_once dirname(__FILE__).'/../lib/stg_log_user_actionsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stg_log_user_actionsGeneratorHelper.class.php';

/**
 * stg_log_user_actions actions.
 *
 * @package    stgcms2
 * @subpackage stg_log_user_actions
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stg_log_user_actionsActions extends autoStg_log_user_actionsActions
{
  public function executeEdit(sfWebRequest $rquest)
  {
    $this->redirect('stg_log_user_actions');
  }
  public function executeDelete(sfWebRequest $rquest)
  {
    $this->redirect('stg_log_user_actions');
  }
}
