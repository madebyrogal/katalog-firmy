<?php

class BaseProviderClass implements ProviderInterface
{
    public $name = "";

    public $order;
    public $value;

    public function getHomePage()
    {
       return $this->homepage;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitleMessage()
    {
        return "";
    }

    public function getContentMessage()
    {
        return "";
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getLink()
    {
        return str_replace('{nr}', $this->value, $this->link);
    }

}