<?php

require_once dirname(__FILE__) . '/../lib/slider_bannersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/slider_bannersGeneratorHelper.class.php';

/**
 * slider_banners actions.
 *
 * @package    stgcms2
 * @subpackage slider_banners
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class slider_bannersActions extends autoSlider_bannersActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@sliders');
  }

}
