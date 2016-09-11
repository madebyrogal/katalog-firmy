<?php
class ApcCollection
{
  private $collection = 'e-dym.pl';
  private static $_instance;

  public static function getInstance($collection = null)
  {
      if (!(self::$_instance instanceof self))
      {
          self::$_instance = new self($collection);
      }
      return self::$_instance;
  }

  // Do not allow an explicit call of the constructor: $v = new Singleton();
  final private function __construct($collection = null)
  {
    if($collection != null)
    {
      $this->collection = $collection.'.';
    }
  }

  // Do not allow the clone operation: $x = clone $v;
  final private function __clone() { }

  public function add($key,$value)
  {
    if(function_exists('apc_store') == true)
    {
      apc_store($this->collection.$key, $value);
    }
  }

  public function get($key)
  {
    if(function_exists('apc_fetch') == true)
    {
      return apc_fetch($this->collection.$key);
    }
    else
    {
      return false;
    }
  }
}

?>
