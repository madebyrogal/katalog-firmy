<?php

require_once dirname(__FILE__).'/../lib/companyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/companyGeneratorHelper.class.php';

/**
 * company actions.
 *
 * @package    sell4
 * @subpackage company
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class companyActions extends autoCompanyActions
{
    
  public function executeNew(sfWebRequest $request) {
    $this->forward404();
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404();
  }
  
  public function executeStats(sfWebRequest $request) 
  {
      $this->object = $this->getRoute()->getObject();
      
      $this->stats = $this->object->getStats();
      
  }

}
