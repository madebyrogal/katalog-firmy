<?php

class DoctrineModels
{
  /**
   * Dla relacji (master) 1:M (slave) ustawia domyślny obiekt klasy (slave) dla klasy (master)
   *
   * @param <type> $slaveObject
   * @param <type> $relationToMaster
   * @param <type> $relationFromMaster
   */
  static public function setDefaultRelationIfNull($slaveObject, $relationToMaster, $relationFromMaster)
  {
    $setMethodName = 'set'.$relationFromMaster;
    $getMethodName = 'get'.$relationFromMaster;

    if ($master = $slaveObject->$relationToMaster) {
      if (!($master->$getMethodName() && $master->$getMethodName()->getPrimaryKey())) { //nie ma jeszcze obiektu domyslnego
        $master->$setMethodName($slaveObject);
        $master->save();
      }
    }
  }

  static public function deleteAllNotInArray($model_name, $field, $allowed_values_array)
  {
    $q = Doctrine::getTable($model_name)->createQuery()->select('*');

    if (count($allowed_values_array)) {
      $q->whereNotIn($field, $allowed_values_array)->count();
      $q->orWhere($field.' IS NULL');
    }
    // else skasuj wszystkie

    return $q->execute()->delete(); //samo delete nie działa i jest to chyba błąd Doctrine
  }

  static public function deleteAllOthers($model_name, $allowed_objects, $field1, $field2)
  {
    $q =  Doctrine::getTable($model_name)->createQuery();

    foreach ($allowed_objects as $allowed_object) {
      if ($allowed_object) {
        $q->andWhere($field1.' != ? OR '.$field2.' != ?', array($allowed_object->get($field1), $allowed_object->get($field2)));
      }
    }

    return $q->execute()->delete(); //samo delete nie działa i jest to chyba błąd Doctrine
  }

}
