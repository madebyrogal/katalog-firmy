<?php

class PlatnosciPayable {

    private $params = array();

    public function setUserParamFrom(Order $order)
    {
        $this->params['pos_id'] = stgConfig::get('payable_platnosci_pos_id');
        $this->params['pos_auth_key'] = stgConfig::get('payable_platnosci_pos_auth_key');

        $this->params['session_id'] = $order->getUid();
        $this->params['amount'] = $order->getValueBrutto();
        $this->params['desc'] = sfContext::getInstance()->getRequest()->getHost().' - zamówienie nr '.$order->getPrimaryKey();
        $this->params['order_id'] = $order->getPrimaryKey();

        $address = $order->getInvoiceAddress();
        $name = explode(' ', $address->getName());

        $this->params['first_name'] = $name[0];
        $this->params['last_name'] = isset($name[1]) ? $name[1] : "";
        $this->params['street'] = $address->getStreet();
        $this->params['street_hn'] = $address->getHouseNo();
        $this->params['street_an'] = $address->getFlatNo();
        $this->params['city'] = $address->getCity();
        $this->params['post_code'] = $address->getPostCode();
        $this->params['email'] = $order->getOrderProfile()->getEmailAddress();
        $this->params['client_ip'] = $_SERVER['REMOTE_ADDR'];
    }

    public function getlinkToPayable()
    {
        $link = ('<form action="https://www.platnosci.pl/paygw/UTF/NewPayment" method="POST" name="payform" style="float: left;margin: 10px;">
                     <input type="hidden" name="first_name" value="'.$this->params['first_name'].'">
                     <input type="hidden" name="last_name" value="'.$this->params['last_name'].'">
                     <input type="hidden" name="email" value="'.$this->params['email'].'">
                     <input type="hidden" name="pos_id" value="'.$this->params['pos_id'].'">
                     <input type="hidden" name="pos_auth_key" value="'.$this->params['pos_auth_key'].'">
                     <input type="hidden" name="session_id" value="'.$this->params['session_id'].'">
                     <input type="hidden" name="amount" value="'.$this->params['amount'].'">
                     <input type="hidden" name="desc" value="'.$this->params['desc'].'">
                     <input type="hidden" name="client_ip" value="'.$this->params['client_ip'].'">
                     <input type="hidden" name="js" value="0">
                     <input type="submit" class="pay_platnosci" title="Zapłać poprzez Platnosci.pl" value="Zapłać poprzez Platnosci.pl">
                  </form>
                    <script language="JavaScript" type="text/javascript">
                    <!--
                         document.forms[’payform’].js.value=1;
                    -->
                    </script>');
        return $link;
    }

    /*
     * Zwraca tablice z wynikiem werytikacji tranzakcji w formie:
     * $tab['result'] = 0 albo 1: 0 - bląd; 1 - wszystko OK
     * $tab['notice'] = komunikat tekstowy
     */
    public function verifyTransaction()
    {
        
    }

}