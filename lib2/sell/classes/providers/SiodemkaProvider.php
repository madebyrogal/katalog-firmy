<?php

class SiodemkaProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.siodemka.com/';

    public $name = 'Siódemka';
    public $link = 'http://www.siodemka.com/index.php?mact=Oracl%2Cm3%2Cdefault%2C1&m3returnid=strefaklienta%2Fznajdz-przesylke&page=strefaklienta%2Fznajdz-przesylke&mact=Oracl%2Cm3%2Cdefault%2C1&m3returnid=strefaklienta%2Fznajdz-przesylke&page=strefaklienta%2Fznajdz-przesylke&m3packageId={nr}&m3packageId1=&m3packageId2=&m3packageId3=&m3submit.x=28&m3submit.y=11&m3submit=znajd%C5%BA';

    public function getTitleMessage()
    {
        return 'Zamówienie zostało zrealizowane';
    }

    public function getContentMessage()
    {
        $html =  'Twoje zamówienie nr <strong>'.$this->order->getPrimaryKey().'</strong> zostało zrealizowane <br /><br />';
        $html .= 'Przesyłkę o numerze <strong>'.$this->value.'</strong> można śledzić na stronie: <br /><br />';
        $html .= '<a href="'.$this->getLink().'">'.$this->getLink().'</a><br /><br />';

        return $html;
    }
}