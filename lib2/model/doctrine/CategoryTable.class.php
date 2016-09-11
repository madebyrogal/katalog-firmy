<?php

/**
 * CategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CategoryTable extends StgDoctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CategoryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Category');
    }
    
    public function addCategoriesToCompany($categories, $company)
    {
        $category_objects = $this->getObjectByArray($categories);
        $categories_description = "";
        foreach($category_objects as $category)
        {
            $tmp = new Company2Category();
            $tmp->setCompany($company);
            $tmp->setCategory($category);
            $tmp->save();
            $categories_description .= ' '.$category->getName().' '.$category->getDescription();
        }
        
        Search::saveSearchIndex(
            array
            (                
                $company->getName(),                
                $company->getDescription(),
                $categories_description,
            ),
            $company
        );
        
    }
    
    public function getObjectByArray($array)
    {
        $q = Doctrine_Query::create()
                ->from('Category')
                ->whereIn('id', $array);
        return $q->execute();
    }
    
    public function getPrimaryLevelTree()
    {
        $q = Doctrine_Query::create()
            ->from('Category')
            ->where('level =?', 1)
            ->orderBy('lft');
        
        return $q->execute();
    }
    
    public function getSubcategories($category, $one_level = true)
    {
        $q = Doctrine_Query::create()
                ->from('Category')
                ->where('lft >=?', $category->getLft())
                ->andwhere('rgt <=?', $category->getRgt())
                ->orderBy('lft');
        if($one_level)
        {
            $q->andWhere('level =?', $category->getLevel()+1);
        }     
        return $q->execute();                
    }
    
    public function getSubcategoriesIds($category)
    {
        $categories = $this->getSubcategories($category, false);
        $return = array();
        if(count($categories) > 0)
        {
            foreach($categories as $one)
            {
                $return[] = $one->getPrimaryKey();
            }
            
        }
        
        return $return;
                
    }
    
        
    static function getTreeCategories($object, $link = true)
    {
        $recursion = __FUNCTION__;
        $out = '';
        if($object->getPrimaryKey() != 1)
        {
            if($link)
            {
                $out .= self::prepare_link($object);
            }
            else
            {
                $out .= $object->getName();
            }
            if ($object->getNode()->hasParent())
            {
                $out = self::$recursion($object->getNode()->getParent(), $link).'<span class="split"> &raquo; </span>'.$out;
            }
        }
        return $out;
    }
    
    static function prepare_link($object)
    {
        use_helper('Url');
        return '<a href="'.url_for('category', $object).'">'.$object->getName().'</a>';
    }
    
}