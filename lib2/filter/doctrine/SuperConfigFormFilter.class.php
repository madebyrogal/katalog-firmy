<?php

/**
 * SuperConfig filter form.
 *
 * @package    stgcms2
 * @subpackage filter
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SuperConfigFormFilter extends BaseSuperConfigFormFilter
{
  //XXX http://forum.symfony-project.org/index.php/m/70130/
    public function getFields()
    {
        return array_merge
        (
            parent::getFields(),
            array
            (
                'scope' => 'ForeignKey'
            )
        );
    }

    public function configure()
    {
        $this->widgetSchema['scope']  =   new sfWidgetFormChoice
            (
            array
            (
                'choices'   => self::getScopeChoices()
            )
        );
    }

    static public function getScopeChoices()
    {
        return array_merge(array(''=>'All'),SuperConfig::getScopeChoices());
    }

}
