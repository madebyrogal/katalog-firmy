<?php

class sendStatsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'stg';
    $this->name             = 'sendStats';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [sendStats|INFO] task does things.
Call it with:

  [php symfony sendStats|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $tmp = Doctrine_Query::create()->select('email_id')->addSelect('company_id')->from('Stats')->execute();
    foreach($tmp as $ids)
    {
      $companyIds[$ids['company_id']] = $ids['company_id'];
    }
    
		$q = CompanyTable::getInstance()->getQueryToStats();
		$companyAll = $q->whereIn('c.id', $companyIds)->execute();

    foreach($companyAll as $company)
    {      
      $company->sendStats();   
    }

  }
}
