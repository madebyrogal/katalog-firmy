<?php

class VipExpressProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.vipexpress.pl/';

    public $name = 'Vip Express';
    public $link = "";

    public function getTitleMessage()
    {
        return 'Zamówienie zostało zrealizowane';
    }

    public function getContentMessage()
    {
        $html =  'Twoje zamówienie nr <strong>'.$this->order->getPrimaryKey().'</strong> zostało zrealizowane <br /><br />';
        $html .= 'Przesyłce został nadany numer: <strong>'.$this->value.'</strong><br /><br />';

        return $html;
    }
}