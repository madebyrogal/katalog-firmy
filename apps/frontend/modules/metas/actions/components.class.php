<?php
class metasComponents extends sfComponents
{
  /**
  * Executes _metas component
  *
  * @param sfWebRequest $request the HTTP Request
  */
  public function executeCompMetas(sfWebRequest $request)
  {
    $metas_settings = sfConfig::get('mod_metas_settings_default_metas');

    try
    {
      if(in_array($this->getContext()->getModuleName(), $metas_settings) || ($this->getContext()->getActionName() == 'search'))
      {
        throw new Exception();
      }
      else
      {
        $module = $this->getContext()->getModuleName();
        $action = $this->getContext()->getActionName();
        $routeObject = $this->getContext()->getController()->getAction($module, $action)->getRoute()->getObject();
        $metas = $routeObject->getMetas();
        if (!$metas->getPrimaryKey())
        {
          throw new Exception();
        }
        $this->metas = Doctrine::getTable('Metas')->getMetas($metas->getPrimaryKey());
      }
    }
    catch(Exception $e)
    {
      $this->metas = Doctrine::getTable('Metas')->getMetas();    //there's no metas for this site, so i get default
    }
  }

}