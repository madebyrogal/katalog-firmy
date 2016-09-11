<?php

require_once dirname(__FILE__) . '/../lib/themesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/themesGeneratorHelper.class.php';

/**
 * themes actions.
 *
 * @package    stgcms2
 * @subpackage themes
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class themesActions extends autoThemesActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->setNewThemes();  //sets new themes if there're any
    $sorts = $this->getSort();
    if (empty($sorts[0]))
    {
      $sorts[0] = 'is_active';
      $sorts[1] = 'desc';
    }
    $this->setSort($sorts);
    parent::executeIndex($request);
    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirect('@themes');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->redirect('@themes');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->redirect('@themes');
  }

  public function executeSwitchActive(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $object->switchActive();
    $this->getUser()->setFlash('notice', 'Szablon zmieniony pomyślnie');
    $this->redirect('@themes');
  }

  /**
   * Sets new themes.
   * Iterates through installed themes and throug themes dir.
   * Checks whether there's any themes that are not installed and installs theme.
   */
  private function setNewThemes()
  {
    $themes_in_dir_names = T::ls(sfConfig::get('sf_web_dir') . '/themes');    //checks what's in themes dir

    $themes_in_db_names = array();

    $themesInDb = Themes::getAll();  //gets all themes
    foreach ($themesInDb as $key => $theme) {
      if (!in_array($theme->getName(), $themes_in_dir_names)) {
        $theme->delete();
      }
      else {
        $themes_in_db_names[$key] = $theme->getName();   //flattens the array so that it represents what T:ls will provide
      }
    }

    foreach ($themes_in_dir_names as $key => $theme) {
      if (!in_array($theme, $themes_in_db_names))   //checks if there's any new themes
      {
        $newTheme = new Themes();   //if there is - sets new theme
        //checks if there's manifest file
        $manifestFile = sfConfig::get('sf_web_dir') . '/themes/' . $theme . '/manifest.yml';
        if (file_exists($manifestFile))  //if theres one
        {
          $manifest = sfYaml::load($manifestFile);    //sets the newTheme properties accordingly to manifest's settings
          $newTheme->author = $manifest['author'];   //sets author
          $newTheme->version = $manifest['version'];   //sets version
          $newTheme->description = $manifest['description'];   //sets version
        }
        //settings that shouldn't be changed by manifest file goes here
        $newTheme->name = $theme;   //names it with directory's name
        $newTheme->is_active = false;   //mark it as inactive, so that currently default theme's not broken

        $newTheme->save();  //saves the theme
      }
    }
  }

}
