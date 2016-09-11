<?php
class SessionCart implements CartInterface
{
    static private $oInstance = false;  //przechowuje obiekt tej instancji

    private $user = null;
    private $session_user = null;
    private $storage = array();

    /**
     * Blocked constructor
     * @param sfGuardUser $user
     */
    private function SessionCart() {}

    /**
     *
     * @param SellProducts $sell_product
     */
    static public function getCart(sfGuardUser $user = null)
    {
        if( self::$oInstance == false )
        {
            self::$oInstance = new self();
            self::$oInstance->user = $user;
            self::$oInstance->session_user = sfContext::getInstance()->getUser();
        }
        return self::$oInstance;
    }

    public function addProduct(Product $product, $quantity = 1)
    {
        $this->addToStorage($product, $quantity);
    }
    public function delProduct(Product $product)
    {
        $this->delFromStorage($product);
    }

    public function getProducts()
    {
        $items = $this->getItems();
        $in = array();
        if($items && count($items) > 0)
        {            
            $pks = array();
            foreach($items as $k => $v)
            {
                $pks[] = $k;
            }
            if($pks)
            {
                $products = ProductTable::getInstance()->findByPks($pks);
                foreach($products as $product)
                {
                    $in[] = array('product' => $product, 'quantity' => $items[$product->getPrimaryKey()]);
                }
            }
        }

        return $in;
    }
    
    public function getQuantity()
    {
        $products = $this->getProducts();
        $quantity = 0;
        foreach($products as $product)
        {
            $quantity += $product['quantity'];
        }
        return $quantity;
    }

    public function getSumNetto()
    {
        $values = $this->getSumValues();
        $price = new stgPrice($values['value_netto']);
        return $price;
    }
    public function getSumBrutto()
    {
        $values = $this->getSumValues();
        $price = new stgPrice($values['value_brutto']);
        return $price;
    }

    public function getSumValues()
    {
        $netto = 0;
        $brutto = 0;
        $products = $this->getProducts();
        foreach($products as $product)
        {
            $netto += $product['product']->getPriceNetto()->asIs() * $product['quantity'];
            $brutto += $product['product']->getPriceBrutto()->asIs() * $product['quantity'];
        }
        $values['value_netto'] = $netto;
        $values['value_brutto'] = $brutto;
        return $values;
    }

    public function update($parameters)
    {
        $storage = $this->getStorage();
        $quanties = $parameters['quantity'];
        foreach($parameters['product_id'] as $product_id)
        {
            if($quanties[$product_id] > 0)
            {
                $storage[$product_id] = $quanties[$product_id];
            }
            else
            {
                unset($storage[$product_id]);                
            }            
        }
        $this->session_user->setAttribute('cart',$storage);
    }
    public function setEmpty()
    {
        $this->session_user->setAttribute('cart',array());
    }

    public function getStorage()
    {
        if(!$this->session_user->hasAttribute('cart'))
        {
            $this->session_user->setAttribute('cart',array());
        }
        return $this->session_user->getAttribute('cart');
    }

    public function addToStorage(Product $product, $quantity = 1)
    {
        $this->storage = $this->getStorage();
        if(isset($this->storage[$product->getPrimaryKey()]))
        {
            $this->storage[$product->getPrimaryKey()] += $quantity;
        }
        else
        {
            $this->storage[$product->getPrimaryKey()] = $quantity;
        }
        $this->session_user->setAttribute('cart',$this->storage);
    }

    public function delFromStorage(Product $product)
    {
        $this->storage = $this->getStorage();
        unset($this->storage[$product->getPrimaryKey()]);
        $this->session_user->setAttribute('cart',$this->storage);
    }

    public function getItems()
    {
        return $this->getStorage();
    }

    public function isEmpty()
    {
        return $this->getQuantity() ? false : true;
    }

}

?>
