<?php

/**
 * BaseContactQueries
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $query_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property clob $query
 * @property string $file
 * 
 * @method integer        getQueryId()  Returns the current record's "query_id" value
 * @method string         getName()     Returns the current record's "name" value
 * @method string         getEmail()    Returns the current record's "email" value
 * @method string         getPhone()    Returns the current record's "phone" value
 * @method clob           getQuery()    Returns the current record's "query" value
 * @method string         getFile()     Returns the current record's "file" value
 * @method ContactQueries setQueryId()  Sets the current record's "query_id" value
 * @method ContactQueries setName()     Sets the current record's "name" value
 * @method ContactQueries setEmail()    Sets the current record's "email" value
 * @method ContactQueries setPhone()    Sets the current record's "phone" value
 * @method ContactQueries setQuery()    Sets the current record's "query" value
 * @method ContactQueries setFile()     Sets the current record's "file" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContactQueries extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_contact_queries');
        $this->hasColumn('query_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'Nazwa',
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'Email',
             'length' => 255,
             ));
        $this->hasColumn('phone', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('query', 'clob', 65532, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => 'Treść zapytania',
             'length' => 65532,
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
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
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}