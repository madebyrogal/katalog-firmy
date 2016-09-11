<?php
/**
 *
 * @author kaliban
 */
interface CartInterface
{
    public function addProduct(Product $product, $quantity = 1);
    public function delProduct(Product $product);


    /*
     *  zwraca w formie:
     *  $cart[]['product] = object
     *  $cart[]['quantity] = integer
     */
    public function getProducts();
    public function getQuantity();
    
    public function getSumNetto();
    public function getSumBrutto();
    public function getSumValues();
    public function update($parameters);
    public function setEmpty();
    public function isEmpty();
    
}
?>
