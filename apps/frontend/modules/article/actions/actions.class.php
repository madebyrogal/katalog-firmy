<?php

/**
 * article actions.
 *
 * @package    sell4
 * @subpackage article
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articleActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless($this->object = $this->getRoute()->getObject());
    $this->forward404Unless($this->object->isPublic($request->getParameter('sf_culture')));
    if($this->object->getIsPublic() == false) { $this->forward404(); }
  }
}
