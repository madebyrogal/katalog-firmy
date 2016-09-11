<?php

class ShipmentTypeForm extends sfForm
{
    private $cart = false;
    private $shipments = false;

    public function __construct($cart)
    {
        $this->cart = $cart;
        $this->shipments = ShipmentTable::getInstance()->findAll()->toArray();        
        $this->removeShipmentIfNeeded();
        
        parent::__construct();
    }

    public function configure()
    {
        $this->setWidgets(array(
        'shipment_id' => new sfWidgetFormInput()
        ));

        $this->setValidators(array(
            'shipment_id' => new sfValidatorString()
        ));

        $this->widgetSchema->setNameFormat('shipment_type[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->widgetSchema['shipment_id']   =   new sfWidgetFormChoice(
            array(
            'choices'   =>  $this->getShipmentChoices()
            )
        );

        foreach($this->shipments as $shipment)
        {
            $this->widgetSchema['shipment_value['.$shipment['id'].']'] = new sfWidgetFormInputHidden();
            $this->widgetSchema['shipment_value['.$shipment['id'].']']->setDefault($shipment['price_brutto']);
        }

        $this->widgetSchema['shipment_id']->setLabel(false);
    }

    public function removeShipmentIfNeeded()
    {
        $products_cart = $this->cart->getProducts();
        $values = ProductTable::getInstance()->getSumValueDetails($products_cart);
        $new_shipments = array();
        foreach($this->shipments as $shipment)
        {
            $remove = false;
            
            if($shipment['weight_min'] > 0)
            {
                if($values['weight'] < $shipment['weight_min'])
                {                    
                    $remove = true;
                }
            }
            if($shipment['weight_max'] > 0)
            {
                if($values['weight'] > $shipment['weight_max'])
                {
                    $remove = true;
                }
            }
            if($shipment['size_min'] > 0)
            {
                if($values['size'] < $shipment['size_min'])
                {
                    $remove = true;
                }
            }
            if($shipment['size_max'] > 0)
            {
                if($values['size'] > $shipment['size_max'])
                {
                    $remove = true;
                }
            }
            if($shipment['value_min'] > 0)
            {
                if($values['value'] < $shipment['value_min'])
                {
                    $remove = true;
                }
            }
            if($shipment['value_max'] > 0)
            {
                if($values['value'] > $shipment['value_max'])
                {
                    $remove = true;
                }
            }

            if(!$remove)
            {
                $new_shipments[] = $shipment;
            }
            
        }

        $this->shipments = $new_shipments;
        
    }
    public function getShipmentChoices()
    {
        $choices = array();
        foreach($this->shipments as $shipment)
        {
            $price = new StgPrice($shipment['price_brutto']);
            $choices[$shipment['id']] = $shipment['name'].' - '.$price->asReal().' brutto';
        }
        return $choices;
    }
}