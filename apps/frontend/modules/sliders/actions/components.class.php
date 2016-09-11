<?php

class slidersComponents extends sfComponents
{

    public function executeCompSlider()
    {
        if((int)$this->slider_id > 0)
        {
            $this->slider = Doctrine::getTable('Sliders')->find($this->slider_id);
        }
        else
        {
            $this->slider = Doctrine::getTable('Sliders')->getDefault();
        }

        if($this->slider)
        {
            $this->banners = $this->slider->getBanners();
            if($this->banners->count() == 0)
            {
                $this->banners = false;
            }
        }
    }
    
}