<?php

class infoTask extends sfBaseTask
{

  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));


    $this->namespace        = 'stg';
    $this->name             = 'info';
    $this->briefDescription = 'Show information from server';
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $ini = ini_get_all();

T::pr('max_execution_time');
T::pr($ini['max_execution_time']);
T::pr('memory_limit');
T::pr($ini['memory_limit']);

  }

}
