<?php

class StgDoctrine_Table extends Doctrine_Table {

  public function queryActive(Doctrine_Query $q = null, $options = array()) {
    $alias_with_dot = isset($options['alias']) ? $options['alias'].'.' : '';
    $q = (is_null($q)) ? $q = $this->createQuery()->select($alias_with_dot.'*') : $q;

    //TODO - sprawdzac czy pole is_active istnieje
    $q->andWhere($alias_with_dot.'is_active = ?', true);

    if (is_array($options)) {
      if (isset($options['sort'])) {
        $q->addOrderBy($alias_with_dot.$options['sort']);
      }
    }
    return $q;
  }

  public function getAncestorsWithoutRoot($category) {
    $q = $this->createQuery()
              ->select('*')
              ->andWhere('level > 0')
              ->andWhere('lft < ?', $category->getLft())
              ->andWhere('rgt > ?', $category->getRgt())
              ->andWhere('root_id = ?', $category->getRootId())
            ;
    return $q->execute();
  }

  public function getActive($options = array()) {
    return $this->queryActive(null, $options)->execute();
  }

  public function countActive($options = array()) {
    return $this->queryActive(null, $options)->count();
  }

  /**
   * Zwraca kolekcje w kolejnosci jak w drzewie.
   * Nieaktywnosc elementu wplywa na nieaktywnosc potomkow tego elementu.
   */
  public function getActiveTree($roots_keys = array(), $root_key_field_name = 'root_key', $is_active_field_name = 'is_active')
  {
    $collection = new Doctrine_Collection($this->getComponentName());
    $block_level = 0;

    if ($this->isTree()) {
      $treeObject = $this->getTree();


      foreach ($treeObject->fetchRoots() as $root) {
        if (count($roots_keys) && in_array($root->get($root_key_field_name), $roots_keys)) {
          foreach ($treeObject->fetchTree(array('root_id' => $root->getPrimaryKey())) as $object) {
            if ( $object->getLevel() <= $block_level) {
              if ($object->get($is_active_field_name)) { //warunek aktywności
                if ($object->getLevel() > 0) { //pomijanie korzenia
                  $collection->add($object);
                }
                $block_level++;
              }
              else {
                $block_level = $object->getLevel();
              }
            } //end if
          } //end foreach
        } //end if
      } //end foreach

    }
    return $collection;
  }

  /**
   * Zwraca kolekcje w kolejnosci jak w drzewie. - ale nie tylko dla korzeni
   * Nieaktywnosc elementu wplywa na nieaktywnosc potomkow tego elementu.
   */
  public function getActiveBranch($root, $is_active_field_name = 'is_active')
  {
    $collection = new Doctrine_Collection($this->getComponentName());

    if ($this->isTree()) {
      $treeObject = $this->getTree();

      if ($root) {
        $block_level = $root->getLevel() + 1;
        foreach ($root->getNode()->getDescendants() as $object) {
          if ( $object->getLevel() <= $block_level) {
            if ($object->get($is_active_field_name)) { //warunek aktywności
              if ($object->getLevel() > 0) { //pomijanie korzenia
                $collection->add($object);
              }
              $block_level++;
            }
            else {
              $block_level = $object->getLevel();
            }
          } //end if
        } //end foreach
      } //end if

    }

    return $collection;
  }

  /**
   * Zwraca kolekcje w kolejnosci jak w drzewie.
   * Nieaktywnosc elementu wplywa na nieaktywnosc potomkow tego elementu.
   */
  public function getActiveTreeByRoots($roots, $is_active_field_name = 'is_active')
  {
    $collection = new Doctrine_Collection($this->getComponentName());
    $block_level = 0;

    if ($this->isTree()) {
      $treeObject = $this->getTree();

      foreach ($roots as $root) {
        foreach ($treeObject->fetchBranch($root->getPrimaryKey()) as $object) {
$block_level = $root->getLevel() + 100;
          if ( $object->getLevel() <= $block_level) {
            if ($object->get($is_active_field_name)) { //warunek aktywności
              if ($object->getLevel() > 0) { //pomijanie korzenia
                $collection->add($object);
              }
              $block_level++;
            }
            else {
              $block_level = $object->getLevel();
            }
          } //end if
        } //end foreach
      } //end foreach

    }
    return $collection;
  }

}