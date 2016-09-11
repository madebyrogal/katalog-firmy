<?php

class DPDProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.dpd.com.pl/';

    public $name = 'DPD Polska';

    public $link = 'http://www.dpd.com.pl/tracking.asp?p1={nr}&przycisk.x=15&przycisk.y=10&przycisk=Wyszukaj&przycisk=Wyszukaj&ID_kat=3&ID=33&Mark=18';

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