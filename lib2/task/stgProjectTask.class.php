<?php

class stgProjectTask extends sfBaseTask
{

  protected function configure()
  {
    // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('task_name', sfCommandArgument::REQUIRED, 'Nazwa klasy stgTaska'),
      new sfCommandArgument('task_options', sfCommandArgument::IS_ARRAY, 'Opcje stgTaska'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

//    $this->addOptions(array(
//      new sfCommandOption('options', null, sfCommandOption::PARAMETER_NONE),
//    ));

    $this->namespace        = 'stg';
    $this->name             = 'task';
    $this->briefDescription = 'Execute task from "config/task"';
    $this->detailedDescription = <<<EOF
Task [synch|INFO] indywidualny dla konkretnego projektu postawionego na core.
Wywołanie:

  [./symfony stg:task nazwataska opcja1 opcja2 opcja3 ... |INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $stgTaskClass = $arguments['task_name'].'StgTask';
//    $stgTask = new importUsersStgTask();
    $stgTask = new $stgTaskClass();
    $stgTask->execute($arguments['task_options']);

  }

}
