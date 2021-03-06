<?php

/**
 * BaseSuperConfig
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $setting
 * @property string $value
 * @property clob $description
 * @property string $scope
 * @property boolean $is_enabled_for_users
 * @property boolean $is_secret
 * 
 * @method string      getSetting()              Returns the current record's "setting" value
 * @method string      getValue()                Returns the current record's "value" value
 * @method clob        getDescription()          Returns the current record's "description" value
 * @method string      getScope()                Returns the current record's "scope" value
 * @method boolean     getIsEnabledForUsers()    Returns the current record's "is_enabled_for_users" value
 * @method boolean     getIsSecret()             Returns the current record's "is_secret" value
 * @method SuperConfig setSetting()              Sets the current record's "setting" value
 * @method SuperConfig setValue()                Sets the current record's "value" value
 * @method SuperConfig setDescription()          Sets the current record's "description" value
 * @method SuperConfig setScope()                Sets the current record's "scope" value
 * @method SuperConfig setIsEnabledForUsers()    Sets the current record's "is_enabled_for_users" value
 * @method SuperConfig setIsSecret()             Sets the current record's "is_secret" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSuperConfig extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_super_config');
        $this->hasColumn('setting', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('value', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'FALSE',
             'length' => 255,
             ));
        $this->hasColumn('description', 'clob', 65532, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => 'DESCRIPTION',
             'length' => 65532,
             ));
        $this->hasColumn('scope', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'OTHER',
             'length' => 255,
             ));
        $this->hasColumn('is_enabled_for_users', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('is_secret', 'boolean', null, array(
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
        
    }
}