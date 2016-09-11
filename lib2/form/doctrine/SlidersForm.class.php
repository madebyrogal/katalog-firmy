<?php

/**
 * Sliders form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SlidersForm extends BaseSlidersForm
{
  public function configure()
  {
      if(!$this->isNew())
      {
          $SliderBanner = new SliderBanners();
          $SliderBanner->setSliderId($this->getObject());
          $SliderBannerForm = new SliderBannersForm($SliderBanner);
          $SliderBannerForm->validatorSchema['name']->setOption('required', false);
          $SliderBannerForm->widgetSchema['slider_id'] = new sfWidgetFormInputHidden();
          $this->embedForm('SliderBannerForm', $SliderBannerForm);
          $this->widgetSchema['SliderBannerForm']->setLabel(false);
      }

      $this->widgetSchema['is_default'] = new sfWidgetFormInputHidden();

  }

  protected function doSave($con = null)
  {
      if(!$this->isNew())
      {

          $SliderBanner = $this->getValue('SliderBannerForm');
          if($SliderBanner['file'] == null && $SliderBanner['user_banner_id'] == "")
          {
              unset($this['SliderBannerForm']);
          }
          
      }

      parent::doSave($con);

  }

}
