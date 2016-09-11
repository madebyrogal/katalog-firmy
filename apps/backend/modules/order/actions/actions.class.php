<?php

require_once dirname(__FILE__).'/../lib/orderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/orderGeneratorHelper.class.php';

/**
 * order actions.
 *
 * @package    sell4
 * @subpackage order
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends autoOrderActions
{
  public function executeNew(sfWebRequest $request) {
    $this->forward404();
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404();
  }

  public function executeDelete(sfWebRequest $request) {
    $this->forward404();
  }
}
