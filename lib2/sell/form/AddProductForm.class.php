<?php

/**
 * SellProducts form.
 *
 * @package    form
 * @subpackage SellProducts
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class AddProductForm extends sfForm
{

    private $product = false;

    public function __construct(Product $product)
    {
        $this->product = $product;

        parent::__construct();
    }

    public function configure()
    {

        $this->widgetSchema->setNameFormat('cart[%s]');

        $this->widgetSchema['quantity'] = new sfWidgetFormInput();
        $this->validatorSchema['quantity'] = new sfValidatorInteger();
        $this->widgetSchema['quantity']->setDefault(1);
        $this->widgetSchema['quantity']->setLabel(false);

        $this->widgetSchema['product_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['product_id'] = new sfValidatorInteger();
        $this->widgetSchema['product_id']->setDefault($this->product->getPrimaryKey());

    }
    
}