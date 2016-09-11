<?php

class Adddescriptiontocategory extends Doctrine_Migration_Base
{

  public function up()
  {
      $this->addColumn('of_category', 'description', 'clob', '65532', array('default' => '', 'notnull' => false));
  }

  public function down()
  {
      $this->removeColumn('of_category', 'description');
  }
}
