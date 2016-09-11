<?php

class UserCartForm extends sfForm
{
    private $cart = false;

    public function __construct($cart)
    {
        $this->cart = $cart;
        parent::__construct();
    }

    public function configure()
    {        
        $products = $this->cart->getProducts();
        foreach($products as $product)
        {
            $this->widgetSchema['product_id['.$product['product']->getPrimaryKey().']'] = new sfWidgetFormInputHidden();
            $this->validatorSchema['product_id['.$product['product']->getPrimaryKey().']'] = new sfValidatorInteger();
            $this->widgetSchema['product_id['.$product['product']->getPrimaryKey().']']->setDefault($product['product']->getPrimaryKey());

            $this->widgetSchema['quantity['.$product['product']->getPrimaryKey().']'] = new sfWidgetFormInput();
            $this->validatorSchema['quantity['.$product['product']->getPrimaryKey().']'] = new sfValidatorInteger();
            $this->widgetSchema['quantity['.$product['product']->getPrimaryKey().']']->setDefault($product['quantity']);
        }
    }
}