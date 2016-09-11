<?php

/**
 * payable actions.
 *
 * @package    sell4
 * @subpackage payable
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blogActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
      $this->redirect('/blog/');
  }
}
