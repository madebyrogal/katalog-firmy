<?php

class UPSProvider extends BaseProviderClass implements ProviderInterface
{
    public $homepage = 'http://www.ups.com/content/pl/pl/index.jsx';

    public $name = 'UPS';

    public $link = 'http://www.ups.com/WebTracking/track?loc=pl_PL&WT.svl=SubNav';

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