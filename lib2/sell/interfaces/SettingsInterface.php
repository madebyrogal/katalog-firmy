<?php
interface SettingsInterface
{

    public function getValues();

    public function getSettingsForObject();

    public function getScope();

    public function diffSettings($defaultSettings, $objectSettings);
    
}