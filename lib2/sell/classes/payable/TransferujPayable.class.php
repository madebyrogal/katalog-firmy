<?php

class TransferujPayable
{
    
    private $params = array();
    
    public function setUserParamFrom(Order $order)
    {
        $this->params['id'] = stgConfig::get('transferuj_id');
        
        $price = new StgPrice($order->getValueBrutto());
        $this->params['kwota'] = StgPrice::asRealWithoutSymbol($price->asIs());
        $this->params['opis'] = 'Zamówienie nr '.$order->getPrimaryKey();
        $this->params['crc'] = $order->getUid();
//        $this->params['md5sum'] = $md5sum;
        $this->params['wyn_url'] = 'http://'.sfContext::getInstance()->getRequest()->getHost().'/payable';
        $this->params['pow_url'] = 'http://'.sfContext::getInstance()->getRequest()->getHost().'/payable_true';
        $this->params['pow_url_blad'] = 'http://'.sfContext::getInstance()->getRequest()->getHost().'/payable_false';

        $profile = $order->getProfile();
        $this->params['email'] = $profile->getGuardUser()->getEmailAddress();
        $this->params['nazwisko'] = $profile->getGuardUser()->getLastName();
        $this->params['imie'] = $profile->getGuardUser()->getFirstName();
        $this->params['adres'] = $profile->getStreet();
        $this->params['miasto'] = $profile->getCity();
        $this->params['kod'] = $profile->getPostCode();
        
    }
    
    public function getlinkToPayable()
    {
        
        $link = ('<form action="https://secure.transferuj.pl/" method="POST" name="payform">
                 <input type="hidden" name="id" value="'.$this->params['id'].'">
                 <input type="hidden" name="kwota" value="'.$this->params['kwota'].'">
                 <input type="hidden" name="opis" value="'.$this->params['opis'].'">
                 <input type="hidden" name="crc" value="'.$this->params['crc'].'">
                 <input type="hidden" name="wyn_url" value="'.$this->params['wyn_url'].'">
                 <input type="hidden" name="pow_url" value="'.$this->params['pow_url'].'">
                 <input type="hidden" name="pow_url_blad" value="'.$this->params['pow_url_blad'].'">
                     
                 <input type="hidden" name="email" value="'.$this->params['email'].'">
                 <input type="hidden" name="nazwisko" value="'.$this->params['nazwisko'].'">
                 <input type="hidden" name="imie" value="'.$this->params['imie'].'">
                 <input type="hidden" name="adres" value="'.$this->params['adres'].'">
                 <input type="hidden" name="miasto" value="'.$this->params['miasto'].'">
                 <input type="hidden" name="kod" value="'.$this->params['kod'].'">
                                  
                 <input type="submit" class="pay_platnosci" title="Zapłać poprzez Transferuj.pl" value="Zapłać poprzez Transferuj.pl">
              </form>');
        return $link;
    }
    
}