<?php

/**
 * Icon form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Bartek Tomżyński <bartekt@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IconForm extends BaseIconForm {

    public function configure() {
        
        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));
        
        //tworze potrzebne katalogi
        T::makeDirs(Icon::getDir(), Icon::getSubdirectories());

        $this->widgetSchema['is_active'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                        'label' => 'Obrazek',
                        'file_src' => '/uploads/icons/max/' . $this->getObject()->getFile(),
                        'is_image' => true,
                        'edit_mode' => !$this->isNew(),
                        'with_delete' => false,
        ));

        $files_settings = sfConfig::get('mod_icon_settings_files');
        $this->validatorSchema['file'] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => Icon::getDir(),
                        'max_size' => $files_settings['max_size'],
                        'mime_types' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'),
        ));
        
    }
}
