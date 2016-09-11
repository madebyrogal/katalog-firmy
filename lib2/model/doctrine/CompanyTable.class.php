<?php

/**
 * CompanyTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CompanyTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CompanyTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Company');
    }

    public function addCompanyFromParameters($params = array(), Profile $profile)
    {
        $object = new Company();
        $object->setProfile($profile);
        $object->setName($params['name']);
        $object->setCity($params['city']);
        $object->setPostCode($params['post_code']);
        $object->setStreet($params['street']);
        $object->setState($params['state']);
        $object->setNip($params['nip']);
        $object->setPhone($params['phone']);
        $object->setMobile($params['mobile']);
        $object->setFax($params['fax']);
        $object->setEmailAddress($params['email_address']);
        //$object->setGG($params['gg']);
        //$object->setSkype($params['skype']);
        $object->setFb($params['fb']);
        $object->setYt($params['yt']);
        $object->setWww($params['www']);
        
        $packet = PricesTable::getInstance()->find($params['packet']);        
        $object->setPacket($packet->getPacket());

        $free = stgConfig::get('of_free_days');
        
        $date_from = date('Y-m-d H:i:s');        
        $date_to = strtotime($date_from) + (60*60*24*$packet->getPeriod()) + (60*60*24*$free);
        
        $object->setRentFrom($date_from);
        $object->setRentTo(date('Y-m-d H:i:s' ,$date_to));
        
        $object->setIsPaid(0);
        $object->setIsActive($this->verifyParameters($params));
        $object->save();
        
        //dodawanie typów
        TypeTable::getInstance()->addTypesToCompany($params['types'], $object);
        
        //dodawanie kategorii
        CategoryTable::getInstance()->addCategoriesToCompany($params['company_categories_list'], $object);
        
        return $object;
    }
    
    public function verifyParameters($params = array(), $send_notify = true)
    {
        $verified = true;

        $cnt = Doctrine_Query::create()
            ->from('Company')
            ->where('nip LIKE  ?', array('%'.$params['nip'].'%'))                
            ->orWhere('phone LIKE ?', array('%'.$params['phone'].'%'))                
            ->orWhere('city LIKE ? AND street LIKE ?', array('%'.$params['city'].'%', '%'.$params['street'].'%'))
            ->count();
        if($cnt > 0)
        {
            $verified = false;
            if($send_notify)
            {
                //wyslanie powiadomienia do admina
                $email = sfGuardUserTable::getInstance()->findOneByUsername('admin')->getEmailAddress();
                $message = Message::getMessageByKey('no_active', array('name' => $params['name']));
                T::systemMail($email, $message->getName(), $message->getContent());                
            }
        }
        else
        {
            $verified = true;
        }

        return $verified;
    }

    private function primaryQuery()
    {
        $free = stgConfig::get('of_free_days');
        $free_date = strtotime(date('Y-m-d H:i:s')) - (60*60*24*$free);
        
        $q = Doctrine_Query::create()
               ->from('Company c')
               ->leftJoin('c.Type t')
               ->leftJoin('c.Categories ca')
               ->where('c.is_active =?', true)
               
               //gdy firma jest w premium i nie została oplacona to sie nie wyswietla 
               //->addWhere('(c.packet = 1 AND c.is_paid = 1 AND c.rent_to >= "'.date('Y-m-d H:i:s').'") OR c.packet = 2 OR (c.rent_from >= "'.date('Y-m-d H:i:s', $free_date).'")')
								
							 //tylko wpisy premium / dodane do usunieciu z serwisu wpisu stadnard
							 //->addWhere('c.packet = 1')
               ->addWhere('(c.is_paid = 1 AND (c.rent_to >= "'.date('Y-m-d H:i:s').'" OR c.rent_to is null )) OR (c.rent_from >= "'.date('Y-m-d H:i:s', $free_date).'")')
								
               //->orderBy('packet')
               ->addOrderBy('name'); // srotuje tylko po nazwie.. wszystkie wpisy są na równi
        
        return $q;
    }
    
    public function getPromoted($count = 4)
    {
        $free = stgConfig::get('of_free_days');
        $free_date = strtotime(date('Y-m-d H:i:s')) - (60*60*24*$free);
        
        $q = Doctrine_Query::create()
           ->select('c.id, RANDOM() AS rand')
           ->from('Company c')
           ->leftJoin('c.Type t')
           ->leftJoin('c.Categories ca')
           ->where('c.is_active =?', true)
           ->addWhere('c.packet =?', 1)     
           ->addWhere('(c.is_paid = 1 AND c.rent_to >= "'.date('Y-m-d H:i:s').'") OR (c.rent_from >= "'.date('Y-m-d H:i:s', $free_date).'")')
           ->orderBy('rand')
           ->addOrderBy('name')
           ->limit($count);
        
        return $q->execute();
        
    }
		
		public function getQueryToStats()
		{
			return $this->primaryQuery();
		}
    
    public function searchContentQuery($params, $category_ids = array())
    {
        
        $user = sfContext::getInstance()->getUser();
        
        $q = $this->primaryQuery();
                
        $text = (isset($params['name']) && $params['name'] != 'Czego szukasz?') ?  $params['name'] : '';
        $place = (isset($params['place']) && $params['place'] != 'Gdzie?') ? trim(strip_tags(strtolower($params['place']))) : '';
        
        
        if(isset($params['type1']))
        {
            $type1 = $params['type1'];
        }
        else if($user->getAttribute('search_type1'))
        {
            $type1 = $user->getAttribute('search_type1');
        }
        else 
        {
            $type1 = '1';
        }
        
        if(isset($params['type2']))
        {
            $type2 = $params['type2'];
        }
        elseif($user->getAttribute('search_type2'))
        {
            $type2 = $user->getAttribute('search_type2');
        }
        else 
        {
            $type2 = '1';
        }
       
        
        if(!empty($text))
        {
            $ids = Search::searchingIds($text);
            if(count($ids) > 0)
            {
                $q->whereIn('id', $ids);
            }
        }         
        
        if(!empty($place))
        {
            $q->andWhere('lower(c.maps) LIKE "%'.$place.'%" OR lower(c.state) LIKE "%'.$place.'%"');
        }
        
        if(count($category_ids) > 0)
        {
            $q->whereIn('ca.id', $category_ids);
        }
        
        
        $user->setAttribute('search_type1', $type1);
        $user->setAttribute('search_type2', $type2);
        
        $types = array();
        
        if($type1 == '1')
        {
            $types[] = 1;
        }
        if($type2 == '1')
        {
            $types[] = 2;
        }
        
        if(count($types) > 0)
        {
            $q->whereIn('t.id', $types);
        }
                   
        return $q;
    }
}