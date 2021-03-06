<?php

/**
 * MetasTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MetasTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object MetasTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Metas');
    }

    public function getFirst()
    {
      return $this->createQuery()->orderBy('meta_id')->fetchOne();
    }

    public function getMetas($meta_id = null)
    {
//      $meta = ($meta_id) ? $this->find($meta_id) : $this->findOneByGenerate(1); //TODO zamiast po Generate szukać po jakimś is_default
      $meta = ($meta_id) ? $this->find($meta_id) : $this->findOneByIsDefault(true); //TODO zamiast po Generate szukać po jakimś is_default


//      return $meta->toArray();
      $translations = $meta->getTranslation();
      return $translations[sfContext::getInstance()->getUser()->getCulture()]->toArray();
    }
}