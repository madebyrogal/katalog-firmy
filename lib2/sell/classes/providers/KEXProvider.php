<?php

class KEXProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://k-ex.pl/';

    public $name = 'K-EX';
    public $link = 'http://kurier.kolporter-express.pl/tnt.php';

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