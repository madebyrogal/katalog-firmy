<?php

/**
 * Galleries form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GalleriesForm extends BaseGalleriesForm
{

  public function configure()
  {

    $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

    unset(
            $this['meta_id'],
            $this['updated_at'],
            $this['is_deletable'],
            $this['is_editable'],
            $this['slug'],
            $this['articles_list'],
            $this['comments_list']
    );

//    $this->widgetSchema['created_at'] = new sfWidgetFormJQueryDate();
//    $this->setDefault('created_at', time());

    $this->embedI18n(Lang::getInstance()->getNotDeleted()->toArray());

    $metas = new MetasForm($this->getObject()->getMetas());
    $this->embedForm('Metas', $metas);

    $this->widgetSchema['created_at'] = new sfWidgetFormJQueryDate();
    $this->widgetSchema['created_at']->setOption('culture', 'pl');
    $this->setDefault('created_at', time());
    
    $this->widgetSchema['ajax_upload'] = new stgAjaxFileUpload(array(
        'label' => ' ',
        'parent_id' => $this->object->getPrimaryKey(),
        'php_callback' => T::url_for('pictures_ajax_upload'),
        'js_callback' => 'showUploadedImage'
    ));

//    if (!$this->isNew())
//    {
//      $this->widgetSchema['file'] = new sfWidgetFormInputFile(array(
//                'label' => 'Obrazek',
//            ));
//
//    $this->validatorSchema['file'] = new sfValidatorFile(array(
//                'required' => false,
//                'path' => sfConfig::get('sf_upload_dir') . '/pictures',
//                'mime_types' => 'web_images',
//            ));
//    }
  }

    protected function doSave($con = null)
    {
        parent::doSave($con);
        $metas = $this->embeddedForms['Metas']->getObject();
        $metas->generateMetas($this->object);
    }

    
}