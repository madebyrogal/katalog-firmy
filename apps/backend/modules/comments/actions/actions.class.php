<?php

require_once dirname(__FILE__) . '/../lib/commentsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/commentsGeneratorHelper.class.php';

/**
 * comments actions.
 *
 * @package    stgcms2
 * @subpackage comments
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentsActions extends autoCommentsActions
{

  public function executeEdit(sfWebRequest $request)
  {
    $this->comments = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->comments);
    $this->form->setDefault(
            'cancel_url', '/'
    );
  }

}
