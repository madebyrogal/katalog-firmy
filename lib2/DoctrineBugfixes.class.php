<?php
/**
 * Description of DoctrineBugfixesclass
 *
 * @author kaliban
 */
class DoctrineBugfixesclass
{
  static public function unlink($object,$modelName)
  {
    $object->unlink($modelName,array(),true);
  }

    /**
     * XXX Object is I18n and has ONE PK (ex. object_id, NO pk(name,surname) allowed)
     * Refers to issue here: http://192.168.1.200:9999/molinocms/changeset/276
     */
    static public function generateSlugOnUpdatedObjectWithI18n(sfDoctrineRecord $object, $conn, $sluggable = 'title', $slug_id = 'slug')
    {
        $pk_names = $object->getTable()->getIdentifierColumnNames();    //zgarnia nazwy kolumn uczestniczacych w kluczu glownym (moze sie skladac z wielu kolumnt, wiec zwraca tablice)
        if(count($pk_names) > 1)
        {
            return false;
        }
        $pk_name = $pk_names[0]; //klucze zlozone dzialaja zle, wiec i tak zgarniam tylko jeden
        if(!$object->isNew())
        {
            $translation_table = $object->getTable()->getTableName().'_translation';  //tworze nazwe tabelki z tlumaczneniami
            $connection = ($conn == null) ? $object->_table->getConnection() : $conn; //zbieram Connection
            $dbh = $connection->getDbh();   //http://groups.google.com/group/doctrine-user/browse_thread/thread/289b73f5b15b1465
            $translation_table_rows = $dbh->query('SELECT * FROM '.$translation_table);  //http://www.php.net/manual/en/pdo.query.php
            $slugs_present = $translation_table_rows->fetchAll(PDO::FETCH_ASSOC);   //pobieram wszystkie tlumaczenia
            $candidates = array();
            $conflicts = array();
            foreach($slugs_present as $slug_present)    //i dla kazdego z nich
            {
                //tworze tablice candydatow
                $candidates[$slug_present[$pk_name]][$slug_present['lang']][$sluggable] = $slug_present[$sluggable];
                $candidates[$slug_present[$pk_name]][$slug_present['lang']][$slug_id] = $slug_present[$slug_id];
                //i potencjalnych konfliktow
                $conflicts[$slug_present['lang']][] = $slug_present[$slug_id];
            }

            foreach($object->Translation as $lang => $translation)    //kazde tlumaczenie
            {
                if(isset($candidates[$object->getPrimaryKey()][$lang]))   //sprawdzam, czy ma odpowiedniego kandydata (jest w bazie z takim jezykiem)
                {
                    $candidate = $candidates[$object->getPrimaryKey()][$lang];    //skracam sobie dostep do kandydata
                    if  //jesli
                    (
                        Doctrine_Inflector::urlize($candidate[$sluggable]) == Doctrine_Inflector::urlize($translation[$sluggable])    //zeslugowany title kandydata jest taki sam jak tlumaczenia
                    )
                    {
                        //To znaczy, ze slug sie nie zmienil
                        $object->Translation[$lang][$slug_id]   =   $candidate[$slug_id].' ';
                        $object->Translation[$lang][$slug_id]   =   trim($object->Translation[$lang][$slug_id]);    //XXX Hack - Gdy wartosc sie nie zmienila, Doctrine nie kuma, ze ma nie korzystac z getSlug!!!
                    }
                    else    //w przeciwnym wypadku
                    {
                        //Slug sie zmienil, wiec szukam konfliktow
                        $slug_candidate = Doctrine_Inflector::urlize($translation[$sluggable]);   //tworze kandydujacego sluga
                        if(in_array($slug_candidate,$conflicts[$lang]))    //jesli znajde konflikt
                        {
                            $object->Translation[$lang][$slug_id]   =   $slug_candidate.'-'.$object->getPrimaryKey().'-'.$lang;   //robie nowego sluga dopisujac do kandydata ID obiektu i jezyk dla SLUGA
                        }
                        else    //jesli nie ma konfliktow
                        {
                            $object->Translation[$lang][$slug_id] = $slug_candidate;    //po prostu zapisuje kandydata
                        }
                    }
                }
            }
        }
    }
}
?>
