<?php

/**
 * SliderBanners form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SliderBannersForm extends BaseSliderBannersForm
{
  private $targets = array (
          '_self' => 'tym samym oknie',
          '_new' => 'nowym oknie'
  );

  public function configure()
  {
    $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                'label' => 'Lub dodaj obrazek',
                'file_src' => '/uploads/slider_banners/' . $this->getObject()->getFile(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => false,
            ));
    $this->validatorSchema['file'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/slider_banners',
                'mime_types' => 'web_images',
            ));


    //if (!$this->isNew() && $this->getObject()->getFile())
    if (!$this->isNew())
    {
      $this->widgetSchema['old_file'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['old_file'] = new sfValidatorString(array('required' => false));
      if($this->getObject()->getFile())
      {
        $this->setDefault('old_file', $this->getObject()->getFile());
      }
    }

    $this->widgetSchema['name']->setLabel('Nazwa');
    $this->widgetSchema['user_banner_id']->setLabel('Wybierz banner');
    $this->widgetSchema['position'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['slider_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['target'] = new sfWidgetFormChoice(array(
                    'choices' => $this->targets,
                    'expanded' => false
    ));
    $this->validatorSchema['target'] = new sfValidatorChoice(array('choices' => array_keys($this->targets)));
  }

  protected function doSave($con = null)
  {
    if (!$this->isNew() && $this->getValue('file') && $this->getValue('old_file'))
    {
      unlink(sfConfig::get('sf_upload_dir') . '/slider_banners/' . $this->getValue('old_file'));
    }
    parent::doSave($con);
  }

}
