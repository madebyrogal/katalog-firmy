<?php

require_once dirname(__FILE__).'/../lib/super_configGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/super_configGeneratorHelper.class.php';

/**
 * super_config actions.
 *
 * @package    stgcms2
 * @subpackage super_config
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class super_configActions extends autoSuper_configActions
{
    public function executeEdit(sfWebRequest $request)
    {
        if(($this->getUser()->isSuperAdmin() == false) && ($this->getRoute()->getObject()->getIsEnabledForUsers() == false))
        {
            $this->getUser()->setFlash('error','Nie masz uprawnień do edycji tej wartości');
            $this->redirect('super_config_super_config');
        }
        else
        {
            parent::executeEdit($request);
        }
    }

//    public function executeArticles(sfWebRequest $request)
//    {
//        $ArticlesSettings = new ArticlesSettings(); //tworze obiekt ustawień dla artykułu
//        $this->object = $this->getRoute()->getObject(); //pobierab okiekt z routingu
//        $this->form = new SettingsForm($ArticlesSettings, $this->object); //tworze formularz dla obiektu z ustawieniami
//        $this->defaults = $this->form->getDefaults();
//        $this->mod = 'articles';
//        //zapisuje formularz
//        if($request->isMethod('post'))
//        {
//            $this->form->save($request->getParameter('settings'));
//            $this->redirect('@settings_articles?article_id='.$this->object->getPrimaryKey());
//        }
//        $this->setTemplate('form');
//    }
//
//    public function executeArtcategories(sfWebRequest $request)
//    {
//
//        $this->object = $this->getRoute()->getObject();
//        $ArtcategoriesSettings = new ArtcategoriesSettings();
//        $this->form = new SettingsForm($ArtcategoriesSettings, $this->object);
//        $this->defaults = $this->form->getDefaults();
//        $this->mod = 'artcategories';
//        if($request->isMethod('post'))
//        {
//            $this->form->save($request->getParameter('settings'));
//            $this->redirect('@settings_artcategories?artcategory_id='.$this->object->getPrimaryKey());
//        }
//        $this->setTemplate('form');
//    }
//
//    public function executeGalleries(sfWebRequest $request)
//    {
//
//        $this->object = $this->getRoute()->getObject();
//        $GalleriesSettings = new GalleriesSettings();
//        $this->form = new SettingsForm($GalleriesSettings, $this->object);
//        $this->defaults = $this->form->getDefaults();
//        $this->mod = 'galleries';
//        if($request->isMethod('post'))
//        {
//            $this->form->save($request->getParameter('settings'));
//            $this->redirect('@settings_galleries?gallery_id='.$this->object->getPrimaryKey());
//        }
//
//        $this->setTemplate('form');
//    }

    public function executeRemove(sfWebRequest $request)
    {
        $name = $request->getParameter('setting_name');
        $mod = $request->getParameter('mod');
        $id = $request->getParameter('id');
        $config = SuperConfig::findByName($name);
        if($config)
        {
            $config->delete();
        }

        switch($mod)
        {
            case 'articles' :
                $this->redirect('@settings_articles?article_id='.$id);
            case 'artcategories' :
                $this->redirect('@settings_artcategories?artcategory_id='.$id);
            case 'galleries' :
                $this->redirect('@settings_galleries?gallery_id='.$id);
        }
    }
}
