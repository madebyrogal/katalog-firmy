<?php

/**
 * Sliders
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    stgcms2
 * @subpackage model
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Sliders extends BaseSliders
{
    //zwraca posortowaną liste banerów w zaleznosci czy banery mają byc losowe czy nie
    public function getBanners()
    {
        if($this->getRandom())
        {
            return $this->getSliderBannersRandom();
        }
        else
        {
            return $this->getSliderBannersByPosition();
        }
    }

    public function getSliderBannersRandomQuery()
    {
        $q = Doctrine_Query::create()
            ->from('SliderBanners b')
            ->select('b.slider_banner_id, RANDOM() AS rand')
            ->where('slider_id =?', $this->getPrimaryKey())
            ->orderby('rand');
        return $q;
    }

    public function getSliderBannersRandom()
    {
        $q = $this->getSliderBannersRandomQuery();
        return $q->execute();
    }


    public function getSliderBannersByPosition($order = 'asc')
    {
        $q = Doctrine_Query::create()
            ->from('SliderBanners')
            ->where('slider_id =?', $this->getPrimaryKey())
            ->orderBy('position '.$order);
        return $q->execute();
    }

    public function switchDefault()
    {
        $sliders = Doctrine::getTable('Sliders')->findAll();
        foreach($sliders as $slider)
        {
            $slider->setIsDefault(false);
            $slider->save();
        }
        $this->setIsDefault(true);
        return $this->save();
    }

    public function switchRandom()
    {
        $this->setRandom(!$this->getRandom());
        return $this->save();
    }

    public function getNextPositionBanner()
    {
        $position = 0;
        $q = Doctrine_Query::create()
            ->from('SliderBanners')
            ->where('slider_id =?', $this->getPrimaryKey())
            ->orderBy('position desc')
            ->limit(1);
        $tmp = $q->fetchArray();
        if($tmp[0]['position'])
        {
            $position = $tmp[0]['position'];
        }
        return ++$position;
    }

    public function save(Doctrine_Connection $conn = null)
    {
        T::cc('frontend');
        return parent::save($conn);
    }

    public function delete(Doctrine_Connection $conn = null)
    {
        $banners = $this->getSliderBanners();
        foreach($banners as $banner)
        {
            $banner->delete();
        }
        T::cc('frontend');
        return parent::delete($conn);
    }
}
