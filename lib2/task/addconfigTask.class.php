<?php

class addconfigTask extends sfBaseTask
{
  protected function configure()
  {
    
     $this->addArguments(array(
       new sfCommandArgument('key', sfCommandArgument::REQUIRED, 'Key config'),
       new sfCommandArgument('value', sfCommandArgument::REQUIRED, 'Value'),
       new sfCommandArgument('scope', sfCommandArgument::OPTIONAL, 'Scope'),
       new sfCommandArgument('for_user', sfCommandArgument::OPTIONAL, 'Options enabled for users'),
     ));

    $this->addOptions(array(
//      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
//      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'stg';
    $this->name             = 'add-config';
    $this->briefDescription = 'Add value to SuperConfig';
    $this->detailedDescription = <<<EOF
The [add-config|INFO] task does things.
Call it with:

  [php symfony add-config|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $set = array();
    $set[$arguments['key']] = $arguments['value'];
    $scope = isset($arguments['scope']) ? $arguments['scope'] : false;
    $for_user = isset($arguments['for_user']) ? $arguments['for_user'] : false;

    stgConfig::add($set, $scope, $for_user);
       
  }
}
