<?php

class PayPalPayable
{
    private $params = array();

    public function setUserParamFrom(Order $order)
    {
        $this->params['email'] = stgConfig::get('payable_paypal_email');
        $this->params['item_name'] = 'ID'.$order->getPrimaryKey();

        $price = new StgPrice($order->getValueBrutto());
        $price = stgPrice::asRealWithoutSymbol($price->asIs());

        $this->params['amount'] = $price;

        $address = $order->getInvoiceAddress();
        $name = explode(' ', $address->getName());

        $this->params['first_name'] = $name[0];
        $this->params['last_name'] = isset($name[1]) ? $name[1] : "";
        $this->params['address1'] = $address->getStreet().' '.$address->getHouseNo();

        $this->params['city'] = $address->getCity();
        $this->params['post_code'] = $address->getPostCode();
    }

    public function getlinkToPayable()
    {
        $link = ('<form action="https://www.paypal.com/cgi-bin/webscr" method="post" accept="utf-8" accept-charset="utf-8" style="float: left;margin: 10px;">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="'.$this->params['email'].'">
	<input type="hidden" name="item_name" value="'.$this->params['item_name'].'">
	<input type="hidden" name="currency_code" value="PLN">
	<input type="hidden" name="amount" value="'.$this->params['amount'].'">

	<input type="hidden" name="address_override" value="1">
	<input type="hidden" name="first_name" value="'.$this->params['first_name'].'">
	<input type="hidden" name="last_name" value="'.$this->params['last_name'].'">
	<input type="hidden" name="address1" value="'.$this->params['address1'].'">
	<input type="hidden" name="address2" value="">
	<input type="hidden" name="city" value="'.$this->params['city'].'">
	<input type="hidden" name="zip" value="'.$this->params['post_code'].'">

	<input type="submit" class="pay_paypal" name="submit" title="Zapłać z PayPal" value="Zapłać z PayPal">
        </form>');

        return $link;
    }

    
}