<?php

class DHLProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.dhl.com.pl/';

    public $link = 'http://www.dhl.com.pl/sledzenieprzesylkikrajowej/szukaj.aspx?m=0&sn={nr}';

    public $name = 'DHL';

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