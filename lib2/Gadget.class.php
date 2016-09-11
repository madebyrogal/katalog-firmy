<?php

/*

SuperConfig - "gadgets":
Rekord "gadgets" w SuperCongig pusiada wartość o strukturze (nawiasy [] są tylko w celu pokazowym - nie ma ich w rekordzie):
[Gadget_keyA]:[ActionplaceA1],[ActionplaceA2],[ActionplaceA3];[Gadget_keyB]:[ActionplaceB1],[ActionplaceB2],[ActionplaceB3];[Gadget_keyC]:[ActionplaceC1],[ActionplaceC2],[ActionplaceC3];

gdzie:
[Gadget_key] to np. GADGET_TWITTER_LIKE
[Actionplace] to np. "frontend|articles|show" (nazwa_aplikacji|nazwa_modułu|nazwa_akcji)

przykład: (dla przejrzystości od nowych linii)
GADGET_FACEBOOK_LIKE:frontend|articles|show,frontend|articles|show_version;
GADGET_TWITTER_LIKE:frontend|articles|show,frontend|articles|show_version;

*/

class Gadget
{
    public static function getSuperConfigGadgetsName() {
      return 'gadgets';
    }

    public static function isPossibleHere($gadget_key) {
      $actionplaces_map = self::getActionplacesMap();

      if (isset($actionplaces_map[$gadget_key])
          && in_array(self::getCurrentActionplace(), $actionplaces_map[$gadget_key])) {
        return true;
      }

      return false;
    }

    public static function getCurrentActionplace()
    {
      $sf_context = sfContext::getInstance();
      $action = $sf_context->getActionName();
      $module = $sf_context->getModuleName();
      $application = $sf_context->getConfiguration()->getApplication();

      $actionplace = $application . '|' . $module . '|' . $action;

      return $actionplace;
    }

    public static function getActionplacesMap()
    {
      $rows = explode(';', self::getSuperConfigGadget());
      $actionplaces_map = array();
      foreach ($rows as $row) {
        $row_parts = explode(':', $row);
        if(isset($row_parts[0]) && isset($row_parts[1])) {
          $gadget_key = $row_parts[0];
          $gadget_actionplaces = explode(',', $row_parts[1]);
          $actionplaces_map[$gadget_key] = $gadget_actionplaces;
        }
      }

      return $actionplaces_map;
    }

    public static function saveActionplacesMap($actionplaces_map)
    {
      stgConfig::add(array(self::getSuperConfigGadgetsName() => self::actionplacesMapToString($actionplaces_map)));
    }

    public static function actionplacesMapToString($actionplaces_map)
    {
      $string = '';
      $rows = array();
      foreach ($actionplaces_map as $gadget_key => $actionplaces) {
        $row = $gadget_key;
        $row .= ':';
        $row .= implode(',', $actionplaces);
        $rows[] = $row;
      }
      $string .= implode(';', $rows);
      return $string;
    }

    public static function getSuperConfigGadget()
    {
      $gadget_config = stgConfig::get(self::getSuperConfigGadgetsName());
      if (!$gadget_config) {
        $default_value = '';
        stgConfig::add(array(self::getSuperConfigGadgetsName() => $default_value));
        return $default_value;
      }
      return $gadget_config;
    }

    public static function addGadget($gadget_key)
    {
      $actionplaces_map = self::getActionplacesMap();

      if (!isset($actionplaces_map[$gadget_key])) {
        $actionplaces_map[$gadget_key] = array();
        self::saveActionplacesMap($actionplaces_map);
      }

      return $actionplaces_map;
    }

    public static function removeGadget($gadget_key)
    {
      $actionplaces_map = self::getActionplacesMap();

      if (isset($actionplaces_map[$gadget_key])) {
        unset($actionplaces_map[$gadget_key]);
        self::saveActionplacesMap($actionplaces_map);
      }
      
      return $actionplaces_map;
    }

    public static function addActionplace($gadget_key, $actionplace)
    {
      $actionplaces_map = self::addGadget($gadget_key);
      $actionplaces_map[$gadget_key][] = $actionplace;

      self::saveActionplacesMap($actionplaces_map);
      return $actionplaces_map;
    }

    public static function removeActionplace($gadget_key, $actionplace)
    {
      $actionplaces_map = self::addGadget($gadget_key);
      if (isset($actionplaces_map[$gadget_key])) {
        foreach ($actionplaces_map[$gadget_key] as $key => $gadget_actionplace) {
          if ($gadget_actionplace == $actionplace) {
            unset($actionplaces_map[$gadget_key][$key]);
          }
        }
        self::saveActionplacesMap($actionplaces_map);
      }
      return $actionplaces_map;
    }

}

?>
