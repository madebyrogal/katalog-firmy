<?php

/**
 * PicturesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PicturesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object PicturesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Pictures');
    }

    public function getWithGalleries()
    {
        $q = $this->createQuery()
                ->from('Pictures p')
                ->leftJoin('p.Galleries g');

        return $q->execute();
    }

    public function findByIds($ids)
    {
        $ids = Tools::filterIds($ids);

        $q = $this->createQuery()
                ->from('Pictures p')
                ->whereIn('p.picture_id', $ids)
                ;

        return $q->execute();
    }

    public function deleteByIds($ids)
    {
        $objects = $this->findByIds($ids);

        foreach ($objects as $object) {
          $object->delete();
        }
//        $ids = Tools::filterIds($ids);
//        $q = $this->createQuery()
//                ->from('Pictures p')
//                ->whereIn('p.picture_id', $ids)
//                ->delete();
//        return $q->execute();
        return true; //TODO możnaby to nie na sztywno
    }

    public function getLastImage($max = 1, $gallery_id = false)
    {
        if ($gallery_id)
        {

            $q = $this->createQuery()
                    ->from('Pictures p')
                    ->where('p.gallery_id = ?', $gallery_id)
                    ->orderBy('created_at desc')
                    ->limit($max);
        }
        else
        {
            $q = $this->createQuery()
                    ->from('Pictures p')
                    ->orderBy('created_at desc')
                    ->limit($max);
        }
        return $q->execute();
    }

    public function getFromEditableGalleries(Doctrine_Query $q)
    {
        $rootAlias = $q->getRootAlias();
        $q->leftJoin($rootAlias . '.Galleries g');
        $q->addWhere('g.is_editable = ?', true);

        return $q;
    }

    public function getRandomPictureByGallery($gallery_id, $limit = 1)
    {
        $q = Doctrine_Query::create()
            ->select('RAND() as rand, p.picture_id')
            ->from('Pictures p')
            ->where('p.gallery_id =?', $gallery_id)
            ->orderBy('rand')
            ->limit($limit);
        
        if($limit == 1)
        {
            return $q->fetchOne();
        }
        else
        {
            return $q->execute();
        }

    }

    public function deleteAllProductOthers($allowed_objects)
    {
      $product_galleries_ids = Doctrine::getTable('Galleries')->getProductGalleriesIds();

      if (count($product_galleries_ids)) {
        $q = $this->createQuery();

        $q->andWhereIn('gallery_id', $product_galleries_ids);

        foreach ($allowed_objects as $allowed_object) {
          if ($allowed_object) {
            $q->andWhere('picture_id != ?', $allowed_object->getPrimaryKey());
          }
        }

        return $q->execute()->delete(); //samo delete nie działa i jest to chyba błąd Doctrine
      }
    }
}