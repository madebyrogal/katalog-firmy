<?php

/**
 * company actions.
 *
 * @package    sell4
 * @subpackage company
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class companyActions extends sfActions
{
    
  public function executeShow(sfWebRequest $request)
  {
      $this->object = $this->getRoute()->getObject();
			
			//$this->forward404If(!$this->object->getPromoted());
      
			//nie ma juz formularza kontaktowego na stronie bo są tylko wpisy premium
			/*$this->form = new CompanyEmailForm();
      $this->form->setCompany($this->object);
      if ($this->getRequest()->isMethod('post'))
      {          
          $this->form->bind($request->getParameter('form'));
          if($this->form->isValid())
          {
              $this->form->save();
              $this->getUser()->setFlash('notice', 'Email został wysłany');
              $this->redirect('company', $this->object);
          }
      }*/
      
      $this->localisation = $this->object->getMaps();

  }

  public function executeSearch(sfWebRequest $request)
  {
      $route = $this->getRoute()->getParameters();
      if(isset($route['slug']))
      {        
        $this->object = $this->getRoute()->getObject();
      }
    
      $categories_ids = $this->getCategoriesIds($request);    
      $this->categories = $this->getSubCategories($request);

      if($this->getRequest()->isXmlHttpRequest())
      {
          $this->setLayout(false);
          $params = $request->getGetParameters();
          $this->is_ajax = true;
      }
      else
      {
          $params = $request->getPostParameters();
          $this->is_ajax = false;
      }
            
      $query = CompanyTable::getInstance()->searchContentQuery($params, $categories_ids);
      $this->pager = new sfDoctrinePager('Company', 10);
      $this->pager->setQuery($query);
      $this->pager->setPage($this->request->getParameter('page', 1));
      $this->pager->init();

      $this->name = $request->getParameter('name');
      $this->place = $request->getParameter('place');
      $this->url = $request->getUri();

  }
  
  private function getCategoriesIds(sfWebRequest $request)
  {
      $ids = array();
      
      $route = $this->getRoute()->getParameters();
      if(isset($route['slug']))
      {
          $category = $this->getRoute()->getObject();
          $ids = CategoryTable::getInstance()->getSubcategoriesIds($category);
      }
      return $ids;
  }
  
  private function getSubCategories(sfWebRequest $request)
  {           
      $route = $this->getRoute()->getParameters();
      $categories = false;
      if(isset($route['slug']))
      {
          $category = $this->getRoute()->getObject();
          $categories = CategoryTable::getInstance()->getSubCategories($category);
          if(count($categories) == 0 && $category->getLevel() > 1)
          {
              $categories = CategoryTable::getInstance()->getSubCategories($category->getNode()->getParent());
          }
      }
      return $categories;
  }
  
  public function executeStatsButton(sfWebRequest $request)
  {
      $this->object = $this->getRoute()->getObject();
      $user = $this->getUser();
      
      /*bez weryfikacji email */
      $this->is_email = true;
      $comapy_ids = ($user->hasAttribute('comapny_ids')) ? $user->getAttribute('comapny_ids') : array();
      if(!isset($comapy_ids[$this->object->getPrimaryKey()]))
      {
        $this->object->addStatsEmail(time());          
        $comapy_ids[$this->object->getPrimaryKey()] = $this->object->getPrimaryKey();
        $user->setAttribute('comapny_ids', $comapy_ids);
      }
      
      
      //weryfikacja email
//      $this->is_email = false;      
//      $comapy_ids = ($user->hasAttribute('comapny_ids')) ? $user->getAttribute('comapny_ids') : array();
//      if(isset($comapy_ids[$this->object->getPrimaryKey()]))
//      {
//          $this->is_email = true;
//      }
//      elseif($request->getParameter('email'))
//      {
//          $this->is_email = true;
//          $this->object->addStatsEmail($request->getParameter('email'));          
//          $comapy_ids[$this->object->getPrimaryKey()] = $this->object->getPrimaryKey();
//          $user->setAttribute('comapny_ids', $comapy_ids);
//      }
      
      
      $this->setLayout(false);
  }
  
  

}
