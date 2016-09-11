<?php

require_once dirname(__FILE__) . '/../lib/slidersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/slidersGeneratorHelper.class.php';

/**
 * sliders actions.
 *
 * @package    stgcms2
 * @subpackage sliders
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class slidersActions extends autoSlidersActions
{

  public function executeSwitchDefault(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $object->switchDefault();
    $this->getUser()->setFlash('notice', 'Slider ustawiony na domyślny');
    $this->redirect('sliders');
  }

  public function executeSwitchRandom(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $object->switchRandom();
    $this->getUser()->setFlash('notice', 'Losowe bannery ustawione');
    $this->redirect('sliders');
  }

  public function executeSliderBannerDelete(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();

    $slider_id = $object->getSliderId();
    $slider = Doctrine::getTable('Sliders')->find($slider_id);
    $object->delete();
    $this->redirect($this->generateUrl('sliders_edit', $slider));
  }

  public function executeSetBannerUp(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $object->setPrevPosition();

    $slider_id = $object->getSliderId();
    $slider = Doctrine::getTable('Sliders')->find($slider_id);
    $this->redirect($this->generateUrl('sliders_edit', $slider));
  }

  public function executeSetBannerDown(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $object->setNextPosition();

    $slider_id = $object->getSliderId();
    $slider = Doctrine::getTable('Sliders')->find($slider_id);
    $this->redirect($this->generateUrl('sliders_edit', $slider));
  }
}
