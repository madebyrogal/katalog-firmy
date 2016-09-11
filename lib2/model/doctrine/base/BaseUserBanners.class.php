<?php

/**
 * BaseUserBanners
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_banner_id
 * @property string $title
 * @property string $file
 * @property boolean $is_active
 * @property string $link
 * @property string $target
 * @property Doctrine_Collection $SliderBanners
 * @property Doctrine_Collection $Menus
 * 
 * @method integer             getUserBannerId()   Returns the current record's "user_banner_id" value
 * @method string              getTitle()          Returns the current record's "title" value
 * @method string              getFile()           Returns the current record's "file" value
 * @method boolean             getIsActive()       Returns the current record's "is_active" value
 * @method string              getLink()           Returns the current record's "link" value
 * @method string              getTarget()         Returns the current record's "target" value
 * @method Doctrine_Collection getSliderBanners()  Returns the current record's "SliderBanners" collection
 * @method Doctrine_Collection getMenus()          Returns the current record's "Menus" collection
 * @method UserBanners         setUserBannerId()   Sets the current record's "user_banner_id" value
 * @method UserBanners         setTitle()          Sets the current record's "title" value
 * @method UserBanners         setFile()           Sets the current record's "file" value
 * @method UserBanners         setIsActive()       Sets the current record's "is_active" value
 * @method UserBanners         setLink()           Sets the current record's "link" value
 * @method UserBanners         setTarget()         Sets the current record's "target" value
 * @method UserBanners         setSliderBanners()  Sets the current record's "SliderBanners" collection
 * @method UserBanners         setMenus()          Sets the current record's "Menus" collection
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserBanners extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_user_banners');
        $this->hasColumn('user_banner_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('title', 'string', 512, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'Krótki tekst',
             'length' => 512,
             ));
        $this->hasColumn('file', 'string', 512, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 512,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('link', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('target', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '_self',
             'length' => 255,
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
             'local' => 'user_banner_id',
             'foreign' => 'user_banner_id'));

        $this->hasMany('Menus', array(
             'local' => 'user_banner_id',
             'foreign' => 'user_banner_id'));
    }
}