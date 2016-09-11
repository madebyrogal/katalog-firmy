<?php

/**
 * default actions.
 *
 * @package    sell4
 * @subpackage default
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    public function executeError404(sfWebRequest $request)
    {
        //$this->article= Doctrine_Query::create()->from('Article')->where('article_id =?', 1)->fetchOne();
    }
    
    public function executeGetCategory(sfWebRequest $request)
    {
        $this->ids = explode(',',(string)$request->getGetParameter('id'));
        
        $this->last = false;
        $this->tree = "";
        
        $this->categories = array();
        $this->categories2 = array();
        $this->categories3 = array();
        
        $this->categories = CategoryTable::getInstance()->getPrimaryLevelTree();
        
        if($this->ids[0] != 0)
        {
            $this->id = $this->ids[0];
            $object = CategoryTable::getInstance()->find($this->ids[0]);
            
            $this->categories2 = CategoryTable::getInstance()->getSubcategories($object);
            if(count($this->categories2) == 0)
            {
                $this->last = true;
                $this->id = $this->ids[0];
                $this->tree = CategoryTable::getTreeCategories($object, false);
            }
            
        }
        if($this->ids[1] != 0)
        {
            $this->id = $this->ids[1];
          
            $object = CategoryTable::getInstance()->find($this->ids[1]);
            
            $this->categories3 = CategoryTable::getInstance()->getSubcategories($object);
            if(count($this->categories3) == 0)
            {
                $this->last = true;
                $this->id = $this->ids[1];
                $this->tree = CategoryTable::getTreeCategories($object, false);
            }
            else
            {
              $this->id = $this->ids[2];
            }
            
        }
        
        if($this->ids[2] != 0) 
        {
           $this->last = true;
           $this->id = $this->ids[2];
           $object = CategoryTable::getInstance()->find($this->ids[2]);
           $this->tree = CategoryTable::getTreeCategories($object, false);
        }
        
        $this->setLayout(false);
    }
    
    public function executeSetCategory(sfWebRequest $request)
    {
        $this->ids = $request->getGetParameter('ids');
        $this->ids = explode(',', $this->ids);
        $q =  Doctrine_Query::create()
               ->from('Category')
               ->whereIn('id', $this->ids);
        $this->categories = $q->execute();
        $this->tree = array();
        
        foreach($this->categories as $category)
        {
            $this->tree[$category->getPrimaryKey()] = CategoryTable::getTreeCategories($category, false);
        }
        
        $this->setLayout(false);
    }
    
    public function executeSitemap(sfWebRequest $request)
    {
      $this->setLayout(false);
      $this->xml = Sitemap::generateXML();
      //T::pr(Sitemap::getAllUrls());
      //exit;
    }
}
