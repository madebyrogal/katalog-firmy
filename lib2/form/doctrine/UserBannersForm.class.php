<?php

/**
 * UserBanners form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserBannersForm extends BaseUserBannersForm
{

    private $targets = array (
          '_self' => 'tym samym oknie',
          '_new' => 'nowym oknie'
    );

    public function configure()
    {
        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

        T::makeDirs(UserBanners::getDir(), UserBanners::getSubdirectories()); //tworze potrzebne katalogi

        $this->widgetSchema['title'] = new sfWidgetFormInputText(array('label' => 'Text'));
        $this->widgetSchema['is_active'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                        'label' => 'Obrazek',
                        'file_src' => '/uploads/user_banners/min/' . $this->getObject()->getFile(),
                        'is_image' => true,
                        'edit_mode' => !$this->isNew(),
                        'with_delete' => false,
        ));

        $files_settings = sfConfig::get('mod_user_banners_settings_files');
        $this->validatorSchema['file'] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => sfConfig::get('sf_upload_dir') . '/user_banners',
                        'max_size' => $files_settings['max_size'],
                        'mime_types' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif', 'application/x-shockwave-flash'),
        ));

        

        $this->widgetSchema['target'] = new sfWidgetFormChoice(array(
                    'choices' => $this->targets,
                    'expanded' => false
        ));
        $this->validatorSchema['target'] = new sfValidatorChoice(array('choices' => array_keys($this->targets)));

    }
}
