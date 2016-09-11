<?php

/**
 * BaseSliders
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $slider_id
 * @property string $name
 * @property boolean $is_default
 * @property integer $width
 * @property integer $height
 * @property boolean $random
 * @property Doctrine_Collection $SliderBanners
 * 
 * @method integer             getSliderId()      Returns the current record's "slider_id" value
 * @method string              getName()          Returns the current record's "name" value
 * @method boolean             getIsDefault()     Returns the current record's "is_default" value
 * @method integer             getWidth()         Returns the current record's "width" value
 * @method integer             getHeight()        Returns the current record's "height" value
 * @method boolean             getRandom()        Returns the current record's "random" value
 * @method Doctrine_Collection getSliderBanners() Returns the current record's "SliderBanners" collection
 * @method Sliders             setSliderId()      Sets the current record's "slider_id" value
 * @method Sliders             setName()          Sets the current record's "name" value
 * @method Sliders             setIsDefault()     Sets the current record's "is_default" value
 * @method Sliders             setWidth()         Sets the current record's "width" value
 * @method Sliders             setHeight()        Sets the current record's "height" value
 * @method Sliders             setRandom()        Sets the current record's "random" value
 * @method Sliders             setSliderBanners() Sets the current record's "SliderBanners" collection
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSliders extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_sliders');
        $this->hasColumn('slider_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('is_default', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('width', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('height', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('random', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));

        $this->option('connection', 'globocam_classic');
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SliderBanners', array(
             'local' => 'slider_id',
             'foreign' => 'slider_id'));
    }
}