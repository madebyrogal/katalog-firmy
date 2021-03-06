<?php

/**
 * ThemesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ThemesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object ThemesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Themes');
    }

    //zwraca obiekt aktywnego szablonu
    public function getActiveTheme()
    {
        $q = Doctrine_Query::create()
                ->from('Themes')
                ->where('is_active = ?', true)
                ->limit(1);

        $tmp = $q->execute();
        if ($tmp)
            return $tmp[0];
        else
            return false;
    }

    static public function getOneByNameQuery($name)
    {
        $q = Doctrine_Query::create()
                ->from('Themes t')
                ->where('t.name = ?', $name);
        return $q;
    }

}