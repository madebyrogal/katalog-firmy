<?php

require_once dirname(__FILE__) . '/../lib/metasGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/metasGeneratorHelper.class.php';

/**
 * metas actions.
 *
 * @package    stgcms2
 * @subpackage metas
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metasActions extends autoMetasActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@edit_default_metas');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirect('@edit_default_metas');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->redirect('@edit_default_metas');
  }

  public function executeEditDefault(sfWebRequest $request)
  {
    $defaultMetas = Doctrine::getTable('Metas')->findOneByIsDefault(true);
    if (!$defaultMetas) {
      $defaultMetas = new Metas();
    }

    $this->redirect('metas_edit', $defaultMetas);
  }

  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getRoute()->getObject()->getIsDefault())
    {
      parent::executeEdit($request);
    }
    else
    {
      $this->forward404();
    }
  }
}
