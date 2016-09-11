<?php

/**
 * PicturesTranslation form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PicturesTranslationForm extends BasePicturesTranslationForm
{
    public function configure()
    {
        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));
        unset(
                $this['is_lang_active']
        );
    }
}
