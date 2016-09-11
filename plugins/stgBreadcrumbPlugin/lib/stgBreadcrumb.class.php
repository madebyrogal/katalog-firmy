<?php

/**
 * sfOrmBreadcrumbs
 * 
 * @package    sfOrmBreadcrumbsPlugin
 * @subpackage lib
 * @author     Nicolò Pignatelli <info@nicolopignatelli.com>
 */
class stgBreadcrumb
{
  protected $config = null;
  protected $module = null;
  protected $action = null; 
  protected $breadcrumbs = array();

  public function __construct($module, $action)
  {
    $this->module = $module;
    $this->action = $action;

    $this->getConfig();
    $this->buildBreadcrumbs();
  }
  
  protected function buildBreadcrumb($item) {
    $request = sfContext::getInstance()->getRequest();
    $routing = sfContext::getInstance()->getRouting();

    if (isset($item['model']) && $item['model'] == true) {
      $object = isset($item['object']) ? $item['object'] :$request->getAttribute('sf_route')->getObject();
      if (isset($item['subobject'])) {
        $subobject = $object->get($item['subobject']);
        $route_object = $subobject;
      } else {
        $route_object = $object;
      }

      if (!$route_object->getPrimaryKey()) {
        return null;
      }

      if (isset($item['method']) && $item['method']) {
        $breadcrumb = array('name' => $route_object->$item['method'](), 'url' => null);
//        $breadcrumb = array('name' => $route_object->$item['method']());
      }
      else {
        $name = preg_replace('/%(\w+)%/e', '$object->get("$1")', $item['name']);

        $url = isset($item['route']) ? $routing->generate($item['route'], $route_object) : null;
        $breadcrumb = array('name' => $name, 'url' => $url);
      }
    } else {
      $url = isset($item['route']) ? $routing->generate($item['route']) : null;
      $breadcrumb = array('name' => $item['name'], 'url' => $url);
    }

    $case = $this->getCaseForItem($item);
    $breadcrumb['name'] = $this->switchCase($breadcrumb['name'], $case);
    $breadcrumb['prefix'] = isset($item['prefix']) ? $item['prefix'] : '';

    return $breadcrumb;
  }

  public function getConfig()
  {
    if($this->config == null)
    {
      $file = sfConfig::get('sf_app_config_dir').'/breadcrumbs.yml';
      $yml = sfYamlConfigHandler::parseYaml($file);
      sfConfig::add($yml);
      
      $this->config = sfConfig::get('sf_orm_breadcrumbs');
    }
    
    return $this->config;
  }
  
  public function getBreadcrumbs()
  {
    return $this->breadcrumbs;
  }
  
  public function getSeparator()
  {
    $config = $this->getConfig();
    return isset($config['_separator']) ? $config['_separator'] : '>';
  }

  public function getRootPrefix()
  {
    $config = $this->getConfig();
    return isset($config['_root_prefix']) ? $config['_root_prefix'] : '';
  }
  
  protected function buildBreadcrumbs()
  {
    if(isset($this->config[$this->module]) && isset($this->config[$this->module][$this->action]))
    {
      $breadcrumbs_struct = $this->config[$this->module][$this->action];
    }
    else
    {
      $breadcrumbs_struct = array();
    }
    
    if(count($breadcrumbs_struct) > 0)
    {
      foreach($breadcrumbs_struct as $item)
      {
        if (isset($item['nested_set_ancestors']) && $item['nested_set_ancestors'] == true) {
          $object = sfContext::getInstance()->getRequest()->getAttribute('sf_route')->getObject();

          if (isset($item['nested_set_subobject'])) {
            $object = $object->$item['nested_set_subobject'];
          }

          $ancestors = is_array(get_slot('active_category_ancestors_ids')) ? get_slot('active_category_ancestors_ids') : $object->getNode()->getAncestors();
          if (is_array($ancestors)) {
            foreach ($ancestors as $ancestor) {
              $ancestor_item = $item;
              $ancestor_item['object'] = $ancestor;
              $this->breadcrumbs[] = $this->buildBreadcrumb($ancestor_item);
            }
          }
        }
        else {
          $this->breadcrumbs[] = $this->buildBreadcrumb($item);
        }
      }
    }
    else
    {
      $lost = isset($this->config['_lost']) ? $this->config['_lost'] : 'somewhere...';
      $this->breadcrumbs = array(array('name' => $lost, 'url' => null));
    }
    
    if(isset($this->config['_root']))
    {
      array_unshift($this->breadcrumbs, $this->buildBreadcrumb($this->config['_root']));
    }
  }
  
  protected function getCaseForItem($item)
  {
    $case = isset($item['case']) ? $item['case'] : null;
	
	if($case == null)
	{  
      $config = $this->getConfig();
      $case = isset($config['_default_case']) ? $config['_default_case'] : null;
	}
	
	return $case;
  }
  
  protected function switchCase($name, $case)
  {
    switch($case)
    {
      case 'ucfirst':
        $name = ucfirst(mb_strtolower($name,'UTF-8'));
        break;
	
	  case 'lcfirst':
        $name = lcfirst(mb_strtolower($name,'UTF-8'));
        break;
      
	  case 'strtolower':
        $name = mb_strtolower($name,'UTF-8');
        break;
		
	  case 'strtoupper':
        $name = mb_strtoupper($name,'UTF-8');
        break;
		
      case 'ucwords':
        $name = ucwords(mb_strtolower($name,'UTF-8'));
        break;
    }
	
	return $name;
  }
  
}
?>