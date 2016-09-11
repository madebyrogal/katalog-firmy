<?php

interface ProviderInterface
{
    public function getName();
    public function getHomePage();

    public function getTitleMessage();
    public function getContentMessage();

    public function setOrder($order);
    public function setValue($value);
}