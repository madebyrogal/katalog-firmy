<?php

class companyComponents extends sfComponents
{

    public function executeSearch(sfWebRequest $request)
    {
        
    }
    
    public function executeMenu(sfWebRequest $request)
    {
        $this->tree = Doctrine_Core::getTable('Category')->getPrimaryLevelTree();
    }
    
    public function executePromoted(sfWebRequest $request)
    {
        $this->objects = CompanyTable::getInstance()->getPromoted(4);
    }

}
