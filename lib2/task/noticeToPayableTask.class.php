<?php

class noticeToPayableTask extends sfBaseTask
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
    $this->name             = 'noticeToPayable';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [noticeToPayable|INFO] task does things.
Call it with:

  [php symfony noticeToPayable|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $days = 7;
    
    $date = time();
    $date = $date + (60*60*24*$days);
    $date = date('Y-m-d', $date);
    
    $q = Doctrine_Query::create()
        ->select()
        ->from('Company')
        ->where('packet =?', true)
        ->andWhere('is_paid =?', true)
        ->andWhere('is_active =?', true)
        ->andwhere('rent_to LIKE "'.$date.'%"');

    
    $companyAll = $q->execute();
    
    
    
    foreach($companyAll as $company)
    {
      $company->sendNoticeToPayable();
    }
    
  }
}
