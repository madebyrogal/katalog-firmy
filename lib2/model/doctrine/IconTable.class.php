<?php

/**
 * IconTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class IconTable extends Doctrine_Table {
    /**
     * Returns an instance of this class.
     *
     * @return object IconTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Icon');
    }

    static public function getOneByPkQuery($pk) {
        $q = Doctrine_Query::create()
                ->from('Icon')
                ->where('id = ?', $pk);
        return $q;
    }

    static public function getOneByFileQuery($file) {
        $q = Doctrine_Query::create()
                ->from('Icon')
                ->where('file = ?', $file);
        return $q;
    }
    
}