<?php

class setupProjectTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
//      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'stg';
    $this->name             = 'setupProject';
    $this->briefDescription = 'Set configuration to project from "config/setupProject.php"';
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

    $file = sfConfig::get('sf_web_dir').'/../config/setupProject.php';

//    if(is_file($file))
//    {
        require_once $file;
//    }
    echo 'SetupProject'."\n";
  }

}
