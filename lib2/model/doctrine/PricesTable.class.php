<?php

/**
 * PricesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PricesTable extends Doctrine_Table
{
    
    public $packets = array(
        1 => "PREMIUM",
        2 => "STANDARD",
    );
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Prices');
    }
    
    public function getPackets()
    {
         return $this->packets;
    }
    
    public function getDefaultPackets()
    {
        $packets = array();        
        $packets[] = $this->find(1);
        $packets[] = $this->find(2);
        $packets[] = $this->find(3);
        $packets[] = $this->find(4);
        return $packets;
    }
    
    public function getDefaultPacketsId()
    {
        $packets = array();
        $packets[1] = ""; //$this->find(1);
        $packets[2] = ""; //$this->find(2);
        $packets[3] = ""; //$this->find(2);
        $packets[4] = ""; //$this->find(2);
        return $packets;
    }
    
}