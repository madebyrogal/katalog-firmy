<?php

class defaultComponents extends sfComponents
{

    public function executeMenu(sfWebRequest $request)
    {
      $lang = sfContext::getInstance()->getUser()->getCulture();
      $lang = Lang::getThisLangOrDefaultIfThisNotActive($lang);

      $root_id = Doctrine::getTable('Menus')->findMenuRoot($this->menu_key, $lang)->getPrimaryKey();
      $this->tree = Tools::Get_Array_Keys_UL(Doctrine::getTable('Menus')->getTree()->fetchRoot($root_id), $this->active, 'prepareLink', true);
    }
    
    public function executeMenu2(sfWebRequest $request)
    {
      $lang = sfContext::getInstance()->getUser()->getCulture();
      $lang = Lang::getThisLangOrDefaultIfThisNotActive($lang);

      $root_id = Doctrine::getTable('Menus')->findMenuRoot($this->menu_key, $lang)->getPrimaryKey();
      $this->tree = Tools::Get_Array_Keys_UL(Doctrine::getTable('Menus')->getTree()->fetchRoot($root_id), $this->active, 'prepareLink', true);
    }
    
    public function executeFlashes(sfWebRequest $request)
    {
      $sf_user = sfContext::getInstance()->getUser();

      $this->showFlashes = false;

      if ($sf_user->hasFlash('notice')) {
        $this->showFlashes = true;
        $this->class = "notice";
      }
      else if ($sf_user->hasFlash('error')) {
        $this->showFlashes = true;
        $this->class = "error";
      }
    }
    
    public function executeQuantity(sfWebRequest $request)
    {
      $this->q = CompanyTable::getInstance()->count() + 20000;
      if($this->q < 300)
      {
        $this->q = false;
      }
        
    }

}
