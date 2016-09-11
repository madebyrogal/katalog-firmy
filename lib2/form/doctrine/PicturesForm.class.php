<?php

/**
 * Pictures form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PicturesForm extends BasePicturesForm
{
  public function configure()
  {
    $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

    unset(
            $this['created_at'],
//            $this['erp_zd_zdjecieid'],
            $this['updated_at']
    );

    $this->embedI18n(Lang::getInstance()->getNotDeleted()->toArray());

    if (!$this->isNew())
    {
      $this->widgetSchema['old_file'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['old_file'] = new sfValidatorString();
      $this->setDefault('old_file', $this->getObject()->getFile());
    }

    $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                'label' => 'Obrazek',
                'file_src' => '/uploads/thumbnails/min/' . $this->getObject()->getFile(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => false,
            ));

    $this->validatorSchema['file'] = new sfValidatorFile(array(
                'required' => $this->isNew(),
                'path' => sfConfig::get('sf_upload_dir') . '/pictures',
                'mime_types' => 'web_images',
            ));

    $this->widgetSchema['gallery_id']->setOption('table_method','getEditable');

  }
  
}
