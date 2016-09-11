<?php

class stgBreadcrumbComponents extends sfComponents
{
  public function executeBreadcrumb(sfWebRequest $request)
  {
    $module = $this->getContext()->getModuleName();
    $action = $this->getContext()->getActionName();

    $stgBreadcrumb = new stgBreadcrumb($module, $action);
    
    $this->root_prefix = $stgBreadcrumb->getRootPrefix();
    $this->breadcrumbs = $stgBreadcrumb->getBreadcrumbs();
    $this->separator = $stgBreadcrumb->getSeparator();
  }
}