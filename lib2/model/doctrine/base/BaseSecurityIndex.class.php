<?php

/**
 * BaseSecurityIndex
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $permission_name
 * 
 * @method integer       getId()              Returns the current record's "id" value
 * @method string        getModel()           Returns the current record's "model" value
 * @method integer       getModelId()         Returns the current record's "model_id" value
 * @method string        getPermissionName()  Returns the current record's "permission_name" value
 * @method SecurityIndex setId()              Sets the current record's "id" value
 * @method SecurityIndex setModel()           Sets the current record's "model" value
 * @method SecurityIndex setModelId()         Sets the current record's "model_id" value
 * @method SecurityIndex setPermissionName()  Sets the current record's "permission_name" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSecurityIndex extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_security_index');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('model', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('model_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('permission_name', 'string', 255, array(
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
        
    }
}