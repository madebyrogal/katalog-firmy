<?php

require_once dirname(__FILE__).'/../lib/cultureGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cultureGeneratorHelper.class.php';

/**
 * culture actions.
 *
 * @package    sell4
 * @subpackage culture
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cultureActions extends autoCultureActions
{
  public function executeActivate(sfWebRequest $request) {
    $this->forward404unless($culture = $this->getRoute()->getObject());
    $culture->setIsActive(true);
    $culture->save();
    $this->redirect($request->getReferer());
  }

  public function executeDeactivate(sfWebRequest $request) {
    $this->forward404unless($culture = $this->getRoute()->getObject());
    if ($culture->canDeactivate()) {
      $culture->setIsActive(false);
      $culture->save();
    }
    $this->redirect($request->getReferer());
  }

  public function executeMoveUp(sfWebRequest $request) {
    $this->forward404unless($culture = $this->getRoute()->getObject());
    if ($culture->canMoveUp()) {
      $culture->promote();
      $culture->save();
    }
    $this->redirect($request->getReferer());
  }

  public function executeMoveDown(sfWebRequest $request) {
    $this->forward404unless($culture = $this->getRoute()->getObject());
    if ($culture->canMoveDown()) {
      $culture->demote();
      $culture->save();
    }
    $this->redirect($request->getReferer());
  }

  public function executeMakeDefault(sfWebRequest $request) {
    $this->forward404unless($culture = $this->getRoute()->getObject());
    if ($culture->canMakeDefault()) {
      $culture->moveToFirst();
      $culture->setIsActive(true);
      $culture->save();
    }
    $this->redirect($request->getReferer());
  }

}
