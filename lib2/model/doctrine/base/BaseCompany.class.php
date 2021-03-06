<?php

/**
 * BaseCompany
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $profile_id
 * @property integer $gallery_id
 * @property integer $meta_id
 * @property string $name
 * @property clob $description
 * @property string $city
 * @property string $post_code
 * @property string $street
 * @property string $state
 * @property clob $maps
 * @property string $nip
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $www
 * @property string $email_address
 * @property string $gg
 * @property string $skype
 * @property string $yt
 * @property string $fb
 * @property integer $packet
 * @property timestamp $rent_from
 * @property timestamp $rent_to
 * @property boolean $is_paid
 * @property boolean $is_active
 * @property Galleries $Galleries
 * @property Metas $Metas
 * @property Profile $Profile
 * @property Doctrine_Collection $Categories
 * @property Doctrine_Collection $Type
 * @property Doctrine_Collection $Email
 * @property Doctrine_Collection $Order
 * @property Doctrine_Collection $Stats
 * @property Doctrine_Collection $Company2Type
 * @property Doctrine_Collection $Company2Category
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getProfileId()        Returns the current record's "profile_id" value
 * @method integer             getGalleryId()        Returns the current record's "gallery_id" value
 * @method integer             getMetaId()           Returns the current record's "meta_id" value
 * @method string              getName()             Returns the current record's "name" value
 * @method clob                getDescription()      Returns the current record's "description" value
 * @method string              getCity()             Returns the current record's "city" value
 * @method string              getPostCode()         Returns the current record's "post_code" value
 * @method string              getStreet()           Returns the current record's "street" value
 * @method string              getState()            Returns the current record's "state" value
 * @method clob                getMaps()             Returns the current record's "maps" value
 * @method string              getNip()              Returns the current record's "nip" value
 * @method string              getPhone()            Returns the current record's "phone" value
 * @method string              getMobile()           Returns the current record's "mobile" value
 * @method string              getFax()              Returns the current record's "fax" value
 * @method string              getWww()              Returns the current record's "www" value
 * @method string              getEmailAddress()     Returns the current record's "email_address" value
 * @method string              getGg()               Returns the current record's "gg" value
 * @method string              getSkype()            Returns the current record's "skype" value
 * @method string              getYt()               Returns the current record's "yt" value
 * @method string              getFb()               Returns the current record's "fb" value
 * @method integer             getPacket()           Returns the current record's "packet" value
 * @method timestamp           getRentFrom()         Returns the current record's "rent_from" value
 * @method timestamp           getRentTo()           Returns the current record's "rent_to" value
 * @method boolean             getIsPaid()           Returns the current record's "is_paid" value
 * @method boolean             getIsActive()         Returns the current record's "is_active" value
 * @method Galleries           getGalleries()        Returns the current record's "Galleries" value
 * @method Metas               getMetas()            Returns the current record's "Metas" value
 * @method Profile             getProfile()          Returns the current record's "Profile" value
 * @method Doctrine_Collection getCategories()       Returns the current record's "Categories" collection
 * @method Doctrine_Collection getType()             Returns the current record's "Type" collection
 * @method Doctrine_Collection getEmail()            Returns the current record's "Email" collection
 * @method Doctrine_Collection getOrder()            Returns the current record's "Order" collection
 * @method Doctrine_Collection getStats()            Returns the current record's "Stats" collection
 * @method Doctrine_Collection getCompany2Type()     Returns the current record's "Company2Type" collection
 * @method Doctrine_Collection getCompany2Category() Returns the current record's "Company2Category" collection
 * @method Company             setId()               Sets the current record's "id" value
 * @method Company             setProfileId()        Sets the current record's "profile_id" value
 * @method Company             setGalleryId()        Sets the current record's "gallery_id" value
 * @method Company             setMetaId()           Sets the current record's "meta_id" value
 * @method Company             setName()             Sets the current record's "name" value
 * @method Company             setDescription()      Sets the current record's "description" value
 * @method Company             setCity()             Sets the current record's "city" value
 * @method Company             setPostCode()         Sets the current record's "post_code" value
 * @method Company             setStreet()           Sets the current record's "street" value
 * @method Company             setState()            Sets the current record's "state" value
 * @method Company             setMaps()             Sets the current record's "maps" value
 * @method Company             setNip()              Sets the current record's "nip" value
 * @method Company             setPhone()            Sets the current record's "phone" value
 * @method Company             setMobile()           Sets the current record's "mobile" value
 * @method Company             setFax()              Sets the current record's "fax" value
 * @method Company             setWww()              Sets the current record's "www" value
 * @method Company             setEmailAddress()     Sets the current record's "email_address" value
 * @method Company             setGg()               Sets the current record's "gg" value
 * @method Company             setSkype()            Sets the current record's "skype" value
 * @method Company             setYt()               Sets the current record's "yt" value
 * @method Company             setFb()               Sets the current record's "fb" value
 * @method Company             setPacket()           Sets the current record's "packet" value
 * @method Company             setRentFrom()         Sets the current record's "rent_from" value
 * @method Company             setRentTo()           Sets the current record's "rent_to" value
 * @method Company             setIsPaid()           Sets the current record's "is_paid" value
 * @method Company             setIsActive()         Sets the current record's "is_active" value
 * @method Company             setGalleries()        Sets the current record's "Galleries" value
 * @method Company             setMetas()            Sets the current record's "Metas" value
 * @method Company             setProfile()          Sets the current record's "Profile" value
 * @method Company             setCategories()       Sets the current record's "Categories" collection
 * @method Company             setType()             Sets the current record's "Type" collection
 * @method Company             setEmail()            Sets the current record's "Email" collection
 * @method Company             setOrder()            Sets the current record's "Order" collection
 * @method Company             setStats()            Sets the current record's "Stats" collection
 * @method Company             setCompany2Type()     Sets the current record's "Company2Type" collection
 * @method Company             setCompany2Category() Sets the current record's "Company2Category" collection
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCompany extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_company');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('profile_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('gallery_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('meta_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'clob', 65532, array(
             'type' => 'clob',
             'notnull' => false,
             'length' => 65532,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('post_code', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('street', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('state', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('maps', 'clob', 65532, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => '',
             'length' => 65532,
             ));
        $this->hasColumn('nip', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('phone', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('mobile', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('fax', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('www', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('email_address', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('gg', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('skype', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('yt', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('fb', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('packet', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 2,
             ));
        $this->hasColumn('rent_from', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => false,
             ));
        $this->hasColumn('rent_to', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => false,
             ));
        $this->hasColumn('is_paid', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
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
        $this->hasOne('Galleries', array(
             'local' => 'gallery_id',
             'foreign' => 'gallery_id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Metas', array(
             'local' => 'meta_id',
             'foreign' => 'meta_id'));

        $this->hasOne('Profile', array(
             'local' => 'profile_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Category as Categories', array(
             'refClass' => 'Company2Category',
             'local' => 'company_id',
             'foreign' => 'category_id'));

        $this->hasMany('Type', array(
             'refClass' => 'Company2Type',
             'local' => 'company_id',
             'foreign' => 'type_id'));

        $this->hasMany('Email', array(
             'refClass' => 'Stats',
             'local' => 'company_id',
             'foreign' => 'email_id'));

        $this->hasMany('Order', array(
             'local' => 'id',
             'foreign' => 'company_id'));

        $this->hasMany('Stats', array(
             'local' => 'id',
             'foreign' => 'company_id'));

        $this->hasMany('Company2Type', array(
             'local' => 'id',
             'foreign' => 'company_id'));

        $this->hasMany('Company2Category', array(
             'local' => 'id',
             'foreign' => 'company_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             'unique' => true,
             'canUpdate' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}