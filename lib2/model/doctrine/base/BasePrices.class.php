<?php

/**
 * BasePrices
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $packet
 * @property integer $period
 * @property integer $price_netto
 * @property integer $price_brutto
 * @property boolean $is_deletable
 * 
 * @method integer getId()           Returns the current record's "id" value
 * @method string  getName()         Returns the current record's "name" value
 * @method integer getPacket()       Returns the current record's "packet" value
 * @method integer getPeriod()       Returns the current record's "period" value
 * @method integer getPriceNetto()   Returns the current record's "price_netto" value
 * @method integer getPriceBrutto()  Returns the current record's "price_brutto" value
 * @method boolean getIsDeletable()  Returns the current record's "is_deletable" value
 * @method Prices  setId()           Sets the current record's "id" value
 * @method Prices  setName()         Sets the current record's "name" value
 * @method Prices  setPacket()       Sets the current record's "packet" value
 * @method Prices  setPeriod()       Sets the current record's "period" value
 * @method Prices  setPriceNetto()   Sets the current record's "price_netto" value
 * @method Prices  setPriceBrutto()  Sets the current record's "price_brutto" value
 * @method Prices  setIsDeletable()  Sets the current record's "is_deletable" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePrices extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_prices');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'STANDARD',
             'length' => 255,
             ));
        $this->hasColumn('packet', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 2,
             ));
        $this->hasColumn('period', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('price_netto', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('price_brutto', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('is_deletable', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));

        $this->option('connection', 'globocam_classic');
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}