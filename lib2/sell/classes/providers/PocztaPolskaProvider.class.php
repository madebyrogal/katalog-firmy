<?php

class PocztaPolskaProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.poczta-polska.pl/';

    public $link = 'http://sledzenie.poczta-polska.pl/';

    public $name = 'Poczta Polska';

    
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