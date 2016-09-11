<?php

class Search
{
    static public function saveSearchIndex($forSearch = array(), $object, $lang = 'pl')
    {
      if (count($forSearch)) {
//        if (!$lang) {
//          $lang == sfContext::getInstance()->getUser()->getCulture();
//        }

        $text = '';
        foreach($forSearch as $t) {
          $text .= ' '.$t;
        }

        $model = get_class($object);    //gets model's name
        $model_id = $object->getPrimaryKey();   //gets objects id
        self::deleteSearchIndex($model, $model_id, $lang); //clears index for updated data
        $keywords = self::generateKeys($text);  //generates keywords
        foreach($keywords as $k => $keyword)    //and performes inserts for every of them
        {
          $index = new SearchIndex();
          $index->model = $model;
          $index->model_id = $model_id;
          $index->keyword = $keyword;
          $index->lang = $lang;
          $index->save();
        }
      }
      return true;
    }

    static function deleteSearchIndex($model,$model_id, $lang = NULL) //NULL - wszystkie języki
    {
        $q = Doctrine_Query::create()->delete('SearchIndex')
                                     ->addWhere('model = ?',$model)
                                     ->addWhere('model_id = ?',$model_id);

        if ($lang) {
          $q->addWhere('lang = ?', $lang);
        }

        return $q->execute();
    }
    
    static public function generateKeys($text)
    {
        $analyzer = new Doctrine_Search_Analyzer_Standard();
        $keywords = array_unique($analyzer->analyze(strip_tags(self::stripPol($text))));
        return $keywords;
    }

    static public function stripPol($text)
    {
        $pol = array('ę','ó','ą','ś','ł','ż','ź','ć','ń','Ę','Ó','Ą','Ś','Ł','Ż','Ź','Ć','Ń','&oacute;','&Oacute;','<br />');
        $stripped = array('e','o','a','s','l','z','z','c','n','E','O','A','S','L','Z','Z','C','N','o','O',' ');
        return str_replace($pol, $stripped, $text);
    }

    static public function searching($text, $lang = 'pl')
    {
        $keywords = self::generateKeys($text);
        $results = array();
        foreach($keywords as $k => $keyword)
        {
            $q = Doctrine_Query::create()
                                ->from('SearchIndex si')
//                                ->addWhere('si.keyword LIKE ?', $keyword.'%')
                                ->addWhere('si.keyword LIKE ?', '%'.$keyword.'%')
                                ->addWhere('si.lang IS NULL OR si.lang = ?', $lang);
            $results[$keyword] = $q->execute()->toArray();
        }
        
        $return = self::makeList($results);
        $return = self::uniqueList($return);
        $return = self::makeObjectList($return);
        return $return;
    }

    static public function makeObjectList($array = array())
    {
        $return = array();
        foreach($array as $model => $items)
        {
            foreach($items as $item)
            {
                $q = Doctrine::getTable($model)->find($item);
                $return[$model][] = $q;
            }
        }
        return $return;
    }

    static public function uniqueList($array = array())
    {
        $models = array();
        $return = array();

        foreach($array as $key => $value)
        {
            $models[$value['model']][]    =   $value['model_id'];
        }
        foreach($models as $model => $values)
        {
            $return[$model] = array_unique($values);
        }
        return $return;
    }

    static public function makeList($array = array())
    {
        $return = array();
        $iterator = 0;
        foreach($array as $key => $values)
        {
            foreach($values as $k => $v)
            {
//                unset($v['id']);
                unset($v['keyword']);
                $return[$iterator]  =   $v;
                $iterator++;
            }
        }
        return $return;
    }

    
//    static public function generateKeys($text,$model,$object)
//    {
//        $stripchars = array('-','_','','-');
//        //array_walk($fruits, 'test_print');
//        $keys = preg_split('/\s+/', strip_tags($text));
//
//        $iterator = 0;
//        foreach($keys as $k => $v)
//        {
//            $v = trim($v);
//            $v = str_replace('&nbsp;','',$v);
//            $v = strtolower(Doctrine_Inflector::unaccent($v));
//            if(!in_array($v,$stripchars))
//            {
//                $keys[$iterator] =  $v;
//            }
//            $iterator++;
//        }
//
//        foreach($keys as $key)
//        {
//            echo 'INSERT INTO '.$model.' key="'.$key.'";<br />';
//        }
////        T::pr($keys);
//        exit;
//    }

	static public function getResult($search)
	{
            //$search = Doctrine_Inflector::urlize($search);    //Metoda z Doctrine do robienia pretty URLi
            //XXX Metoda z Doctrine do pozbywania sie akcentow (ą,ę,ź) z tekstu
            //potrzebne, bo klucze są bez akcentów, a stringi po których szukamy
            //czasem je mają
            //Dodatkowo: strtolower - bo klucz jest z małej litery.
            //Prawdopodobnie jest jakaś metoda, która robi to wszystko na raz, ale jeszcze nie znalazłem :)
            $search = strtolower(Doctrine_Inflector::unaccent($search));   
	/*
		echo '<pre>';
		print_r(sfConfig::getAll());
		echo '</pre>';
		*/
		

		
		$aResultSearch = array();
		$aAllModuleSearch = sfConfig::get('mod_search_settings_module');
		
		$aSearchConfig = sfConfig::get('mod_search_settings_main');
				
		foreach($aAllModuleSearch as $sModuleName => $aModuleSettings)
		{
			// relevance - jeszcze nie zrobione, ma dawac wyniki tylko do max_relevance
			//$iMaxRelevance = $aModuleSettings['max_relevance'] ? $aModuleSettings['max_relevance'] : $aSearchConfig['max_relevance'];
			$sModelName = $aModuleSettings['model'];
			
			$q = Doctrine::getTable($sModelName)->search($search);
			
			$aResultSearch[$sModuleName] = $q;
		}

		return $aResultSearch;
		
	}
	
	
	static public function getObjectResult($sModelName, $aModuleIds)
	{
		$aAllModuleSearch = sfConfig::get('mod_search_settings_module'); //ustawienia glownego searcha
		$id_name = '';
		foreach($aAllModuleSearch as $k => $v) //wydobywa nazwe pola id dla kontetnego modulu ($sModelName)
		{
			if($sModelName == $v['model'])
			{
				$id_name = 	$v['id_name'];
				break;
			}
		}
		if(!empty($id_name)) // czy wydobycie nazwy pola id przebieg�o poprawnie
		{
			//wyszukiwanie z bazy danych i utworzenie z winik�w obiekr�w  dla id podanych w tablicy $aModuleIds
			$q = Doctrine_Query::create()
			->from($sModelName)
			->whereIn($id_name, $aModuleIds);
			return $q->execute();
		} 
		else 
		{
			return false;
		}
	}

        static public function getIndex($text)
        {
            $keys = self::generateKeys($text);
            $string = '';
            foreach($keys as $k)
            {
                $string .= $k.' ';
            }
            return $string;
        }
        
        static public function searchingIds($text, $lang = 'pl', $model = false)
        {
            $keywords = self::generateKeys($text);
            $return = array();
            $tmp = array();
            foreach($keywords as $keyword)
            {
                $q = Doctrine_Query::create()
                        ->from('SearchIndex si')
                        ->select('si.model_id')
                        ->where('si.keyword LIKE ?', '%'.$keyword.'%')
                        ->addWhere('si.lang IS NULL OR si.lang = ?', $lang);
                
                if($model)
                {
                    $q->addWhere('si.model =?', $model);
                }
                $result = $q->fetchArray();
                
                foreach($result as $one)
                {
                    $tmp[] = $one['model_id'];
                }
                
                $arrays[] = $tmp;
                $tmp = array();
                
            }
            //T::pr($arrays);
            foreach($arrays as $array)
            {
                if(count($array) > 0)
                {
                    if(count($return) == 0)
                    {
                        $return = $array;
                    }
                    else
                    {
                        $return = array_intersect($return, $array);
                    }
                }
                else
                {
                    $return = array();
                    $return[] = 0;
                    break;
                }
            }
            
            //echo '----<br />';
            //T::pr($return);
            
            return $return;
        }

}