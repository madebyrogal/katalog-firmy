<?php

class forceMigrationTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    $this->addArguments(array(
      new sfCommandArgument('version', sfCommandArgument::OPTIONAL, 'Wersja migracji'),
    ));

    $this->namespace        = 'stg';
    $this->name             = 'force-migration';
    $this->briefDescription = 'Change migration on database';
    $this->detailedDescription = <<<EOF
The [addPermissions|INFO] task does things.
Call it with:

  [php symfony stg:setupProject|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $migration = new Doctrine_Migration();
    $old_version = $migration->getCurrentVersion();

    echo 'Stary numer migracji: '.$old_version."\n";
    
    if (isset($arguments['version'])) {
      $version = (int) $arguments['version'];
      $migration->setCurrentVersion($version);
      echo 'Nowy numer migracji: '.$version."\n";
    }
  }
}
