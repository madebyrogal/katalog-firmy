<?php

/**
 * Pictures form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lightPicturesForm extends BasePicturesForm {

    public function configure() {
        unset(
                $this['created_at'], $this['updated_at'], $this['erp_zd_zdjecieid'], $this['rate_sum'], $this['rate_hits']
        );

        $this->widgetSchema['gallery_id'] = new sfWidgetFormInputHidden();

        $this->widgetSchema['file'] = new sfWidgetFormInputFile(array(
                    'label' => 'Obrazek'
                ));

        $this->validatorSchema['file'] = new sfValidatorFile(array(
                    'required' => $this->isNew(),
                    'path' => sfConfig::get('sf_upload_dir') . '/pictures',
                    'mime_types' => 'web_images',
                ));
    }

}
