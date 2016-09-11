<?php
class StgPriceCollection implements IteratorAggregate
{
    private $items = array();

    public function add(StgPrice $object)
    {
      $this->items[spl_object_hash($object)] = $object;
    }

    public function del(StgPrice $object)
    {
        unset($this->items[spl_object_hash($object)]);
    }

    public function getAll()
    {
        return $this->items;
    }

    public function getIterator()
    {
        $data = $this->items;
        return new ArrayIterator($data);
    }

    public function getSum()
    {
      $sum = 0;
      $prices = $this->getAll();
      foreach($prices as $price)
      {
        $sum = $sum + $price->getForCountry($price->getCulture())->asIs();
      }
      return new StgPrice($sum);
    }
}
?>
