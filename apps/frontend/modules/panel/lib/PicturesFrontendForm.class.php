<?php

class PicturesFrontendForm extends BasePicturesForm
{
    public function configure()
    {
         unset($this['created_at']);
         unset($this['updated_at']);
         unset($this['rate_sum']);
         unset($this['rate_hits']);
         unset($this['erp_zd_zdjecieid']);
         
         
         
         $this->widgetSchema['gallery_id'] = new sfWidgetFormInputHidden();
         
         $this->widgetSchema['file'] = new sfWidgetFormInputFile(array(
                'label' => 'Obrazek',
         ));

         $this->validatorSchema['file'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/pictures',
                'mime_types' => 'web_images',
         ));
    }
    
    public function setGallery($gallery)
    {
        $this->setDefault('gallery_id', $gallery->getPrimaryKey());
    }

  
}
