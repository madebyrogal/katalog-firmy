<?php

/**
 * UserLogos form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserLogosForm extends BaseUserLogosForm
{

  public function configure()
  {
    $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

    T::makeDirs(UserLogos::getDir(), UserLogos::getSubdirectories()); //tworze potrzebne katalogi

    $this->widgetSchema['title'] = new sfWidgetFormInputText(array('label' => 'Text'));
    $this->widgetSchema['is_active'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                'label' => 'Obrazek',
                'file_src' => '/uploads/user_logos/min/' . $this->getObject()->getFile(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => false,
            ));

    $files_settings = sfConfig::get('mod_user_logos_settings_files');
    $this->validatorSchema['file'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/user_logos',
                'max_size' => $files_settings['max_size'],
                'mime_types' => 'web_images',
            ));
  }

}
