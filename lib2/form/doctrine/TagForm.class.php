<?php

/**
 * Tag form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TagForm extends BaseTagForm
{

    public function configure()
    {

        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

        unset(
                $this['id'],
                $this['name'],
                $this['record_key'],
                $this['lang'],
                $this['slug'],
                $this['articles_list']
        );

        $this->widgetSchema['new_tags'] = new sfWidgetFormInput
                (
                array('label'   =>  false),
                array(
                        'size'   =>  '32',
                        'id' => 'new_tags',
                        'autocomplete' => "off",
                        'style' => 'color:#aaa'
                )
        );
        $this->setValidator('new_tags', new sfValidatorString(array('required' => false)));

        $this->widgetSchema['remove_tags'] = new sfWidgetFormInputHidden();
        $this->setValidator('remove_tags', new sfValidatorString(array('required' => false)));
    }
}
