<?php

class StgTree {
  
  public static function stgTreeDataDecode($string) {
    $def_obj_separator = '|';
    $def_field_separator = '#';
    $def_value_separator = ':';

    $nodes = explode($def_obj_separator, $string);

    $nested_array = array();
    foreach ($nodes as $node) {
      $fields = explode($def_field_separator, $node);
      $fields_array = array();
      foreach ($fields as $field) {
        $values = explode($def_value_separator, $field);
        $field_name = $values[0];
        $field_value = $values[1];
        if ($field_name == 'id') {
          $object_id = $field_value;
        }
        else {
          $fields_array[$field_name] = $field_value;
        }
      }
      $nested_array[$object_id] = $fields_array;
    }
    return $nested_array;
  }


  public static function treeUpdate($request, $model)
  {
    $nested_array = StgTree::stgTreeDataDecode($request->getParameter('data'));

    foreach ($nested_array as $id => $fields_array) {
      $object = Doctrine::getTable($model)->find($id);
      foreach ($fields_array as $field_name => $field_value) {
        $object->set($field_name, $field_value);
      }
      $object->save();
    }

    exit();
  }

//  public static function getTreeAsCollectionsArray($model)
//  {
//    $collections_array = array();
//    $block_level = 0;
//
//    $table = Doctrine::getTable($model)->getInstance();
//
//    if ($table->isTree()) {
//      $treeObject = $table->getTree();
//
//      foreach ($treeObject->fetchRoots() as $root) {
//        if ($root->isEditableRoot()) { // obiekt w modelu musi mieć zaimplementowaną taką metodę
//          $collection = new Doctrine_Collection($model);
//            foreach ($treeObject->fetchTree(array('root_id' => $root->getPrimaryKey())) as $object) {
//              if ( $object->getLevel() <= $block_level) {
//                  if ($object->getLevel() > 0) { //pomijanie korzenia
//                    $collection->add($object);
//                  }
//                  $block_level++;
//              } //end if
//            } //end foreach
//          $collections_array[] = array('collection' => $collection, 'root' => $root);
//        }
//      } //end foreach
//
//    }
//    return $collections_array;
//  }


  // Czy obiekt ma wartości pól takie jak w $necessary_values
  public static function hasFieldsValues($object, $necessary_values)
  {
    foreach ($necessary_values as $field => $value) {
      if (is_array($value)) {
        if (!in_array($object->get($field), $value)) { // jeśli podano tablicę wartości to są to możliwe wartości
          return false;
        }
      }
      else {
        if ($object->get($field) != $value) { // jeśli nie podano tablicę tylko konkretną wartość to jest to wartość konieczna
          return false;
        }
      }
    }
    return true;
  }

  public static function getTreeAsCollectionsArray($model, $necessary_values = array())
  {
    $collections_array = array();
    $block_level = 0;

    $table = Doctrine::getTable($model)->getInstance();

    if ($table->isTree()) {
      $treeObject = $table->getTree();

      foreach ($treeObject->fetchRoots() as $root) {
        if (self::hasFieldsValues($root, $necessary_values) && $root->isEditableRoot()) { // obiekt w modelu musi mieć zaimplementowaną taką metodę
          $collection = new Doctrine_Collection($model);
            foreach ($treeObject->fetchTree(array('root_id' => $root->getPrimaryKey())) as $object) {
              if ( $object->getLevel() <= $block_level) {
                  if ($object->getLevel() > 0) { //pomijanie korzenia
                    $collection->add($object);
                  }
                  $block_level++;
              } //end if
            } //end foreach
          $collections_array[] = array('collection' => $collection, 'root' => $root);
        }
      } //end foreach

    }
    return $collections_array;
  }

}