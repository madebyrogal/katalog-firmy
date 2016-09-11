<?php

class Addcompanyfbandytcolumns extends Doctrine_Migration_Base
{
  static function isDone()
  {
     return T::dbFieldExists('of_company', 'fb') && T::dbFieldExists('of_company', 'yt') ;
  }

  public function up()
  {
    if (!self::isDone()) 
    {
      $this->addColumn('of_company', 'fb', 'varchar', '255', array('default' => '', 'notnull' => false));
      $this->addColumn('of_company', 'yt', 'varchar', '255', array('default' => '', 'notnull' => false));
    }
  }

  public function down()
  {
  }
}
