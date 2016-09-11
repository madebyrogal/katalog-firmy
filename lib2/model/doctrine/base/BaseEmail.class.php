<?php

/**
 * BaseEmail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $email
 * @property Doctrine_Collection $Company
 * @property Doctrine_Collection $Stats
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getEmail()   Returns the current record's "email" value
 * @method Doctrine_Collection getCompany() Returns the current record's "Company" collection
 * @method Doctrine_Collection getStats()   Returns the current record's "Stats" collection
 * @method Email               setId()      Sets the current record's "id" value
 * @method Email               setEmail()   Sets the current record's "email" value
 * @method Email               setCompany() Sets the current record's "Company" collection
 * @method Email               setStats()   Sets the current record's "Stats" collection
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEmail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_email');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
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
        $this->hasMany('Company', array(
             'refClass' => 'Stats',
             'local' => 'email_id',
             'foreign' => 'company_id'));

        $this->hasMany('Stats', array(
             'local' => 'id',
             'foreign' => 'email_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}