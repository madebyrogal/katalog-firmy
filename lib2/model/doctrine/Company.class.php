<?php

/**
 * Company
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Company extends BaseCompany
{
    public function getPacketName()
    {
        $packets = PricesTable::getInstance()->getPackets();
        return $packets[$this->getPacket()];
    }
    
    public function save(Doctrine_Connection $conn = null)
    {
        
        $gallery = ($this->Galleries->count()) ? $this->Galleries : new Galleries();
        $gallery->setName('Galeria firmy: '.$this->getName());
        $gallery->setIsDeletable(false);
        $gallery->setIsEditable(false);
        $this->Galleries = $gallery;
        
        $maps = $this->getStreet().', '.$this->getPostCode().' '.$this->getCity();
        
        $this->setMaps($maps);
                
        if ($this->isNew()) { $this->Metas = Metas::createAndSave(); }
        $meta = $this->Metas->generateMetas($this);
        
        $r = parent::save($conn);
        
        $categories_description = $this->getCategoriesDescription();
        
        Search::saveSearchIndex(
            array
            (                
                $this->getName(),                
                $this->getDescription(),
                $categories_description,
            ),
            $this
        );
        
        return $r;
                
    }
    
    public function delete(Doctrine_Connection $conn = null)
    {        
        $this->Galleries->setIsDeletable(true);
        $this->Galleries->delete();

        Metas::deleteByObject($this);
        Search::deleteSearchIndex(get_class($this), $this->getPrimaryKey());
        
        $orders = $this->getOrder();
        foreach($orders as $order)
        {
          $order->delete();
        }
                
        $this->getProfile()->getGuardUser()->delete();
        
        parent::delete($conn);
        
        return true;
    }
    
    public function getStats()
    {
        $q = Doctrine_Query::create()
               ->from('Stats')
               ->select('email_id, company_id, DATE_FORMAT(created_at, "%Y-%m-01") as date, count(email_id)')
               ->where('company_id =?', $this->getPrimaryKey())
               ->groupBy('date')
               ->orderBy('created_at desc');
        return $q->fetchArray();
    }
    
    public function addStatsEmail($email)
    {
        $object = EmailTable::getInstance()->findOneByEmail($email);
        if(!$object)
        {
            $object = new Email();
            $object->setEmail($email);
            $object->save();
        }
        $cnt = Doctrine_Query::create()->from('Stats')->where('email_id =?', $object->getPrimaryKey())->andWhere('company_id =?', $this->getPrimaryKey())->count();
        if($cnt == 0)
        {
            $stats = new Stats();
            $stats->setEmail($object);
            $stats->setCompany($this);
            $stats->save();
        }
        $user = sfContext::getInstance()->getUser();
        $allow_company = ($user->hasAttribute('allow_comapny')) ? $user->getAttribute('allow_comapny') : array();
        $allow_company[$this->getPrimaryKey()] = $this->getPrimaryKey();
        $user->setAttribute('allow_comapny', $allow_company);
    }

    public function getPromoted()
    {
        $now = strtotime(date('Y-m-d H:i:s'));
        $free = stgConfig::get('of_free_days');
        $free_date = strtotime(date('Y-m-d H:i:s')) - (60*60*24*$free);
				        
				if($this->getPacket() == 1 && ((($this->getIsPaid() &&  (strtotime($this->getRentTo()) >= $now) || !strtotime($this->getRentTo()))) || (strtotime($this->getRentFrom()) >= $free_date)))								
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function getDaysLeft()
    {
        $now = time();
        $date = strtotime($this->getRentTo());

        $days = $date - $now;
        if($days > 0)
        {
            $days = ceil($days / 86400);
            return $days;
        }
        else
        {
            return 0;
        }
       
    }
    
    public function getLastOrder()
    {
        $q = Doctrine_Query::create()
                ->from('Order')
                ->where('company_id =?', $this->getPrimaryKey())
                ->orderBy('created_at desc')
                ->limit(1);
        return $q->fetchOne();
    }
    
    public function showButtonPayable()
    {
        $order = $this->getLastOrder();
        $payable_object = new TransferujPayable();
        $payable_object->setUserParamFrom($order);
        $payable = $payable_object->getlinkToPayable();
        return $payable;
    }
    
    public function sendStats()
    {      
      $title = 'Statystyki firmy z serwisu OceanFirm.pl';
      $to = $this->getProfile()->getGuardUser()->getEmailAddress();
//      $to = 'pawel@studiotg.pl';
      
      $message = self::getHTMLstat();
      $message = str_replace('{HOST}', 'http://oceanfirm.pl/', $message);
      
      $date = date('Y-m-d');
      $message = str_replace('{date}', $date, $message);
//      $message = str_replace('{name}', $this->getName(), $message);
        
      $stats = $this->getStats();
      
//      $message .= '<table><tr><th style="border-bottom: 1px solid #000; border-right: 1px solid #000;">Data</th><th style="border-bottom: 1px solid #000;">Liczba osób zainteresowanych danymi kontaktowymi</th></tr>';
//        
//        
      $count = 0;
      $first_month = 0;
      $first_count = 0;      
			$m = date('m');
      foreach($stats as $one)
      {
				if($m == date('m', strtotime($one['date'])))
		    {
					$first_count = $one['count'];
				}
//        if($first_month == 0)
//        {
//          $first_month = T::getMonth(date('m', strtotime($one['date']))).' '.date('Y', strtotime($one['date']));
//          $first_count = $one['count'];
//        }        
        $count += $one['count'];
      }
      $message = str_replace('{first_month}', T::getMonth(date('m')), $message);
      $message = str_replace('{first_count}', $first_count, $message);
      $message = str_replace('{count}', $count, $message);
             
      $headers = '';
      $headers  .= 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $headers .= "From: Oceanfirm.pl <biuro@oceanfirm.pl>\r\n";
      
      if($first_count > 10)
      {
          mail($to, $title, $message, $headers);
      }
      
    }
    
    public function sendNoticeToPayable()
    {      
      $title = 'Koniec pakietu PREMIUM w serwise OceanFirm.pl';
      $to = $this->getProfile()->getGuardUser()->getEmailAddress();
      
      $message = 'Kończy sie okres płatny w serwisie OceanFirm.pl<br /><br />Zaloguj sie do panelu klienta <a href="http://ocenafirm.pl/panel">http://ocenafirm.pl/panel</a> i przedłuż pakiet PREMIUM';
             
      $headers = '';
      $headers  .= 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $headers .= "From: Oceanfirm.pl <biuro@oceanfirm.pl>\r\n";
      
      mail($to, $title, $message, $headers);
    }
    
    public function getCategoriesDescription()
    {
      $categories = $this->getCategories();
      $text = '';
      foreach($categories as $category)
      {
        $text .= ' '.$category->getName().' '.$category->getDescription();
      }
      return $text;
    }
    
    static function getHTMLstat()
    {
      $html = ('<center>
      <table width="569" cellpadding="0" cellspacing="0" border="0"> 		
      <tr>
        <td colspan="3">
          <img src="{HOST}gfx/gora.jpg" />
        </td>
      </tr>
      <tr>
        <td width="10"></td>
              <td style="background: #c2f2ff;">

          

              <center>
                  <span style="font: bold 22px Arial; color: #153657;">{first_month}</span><br />
                  <span style="font: 13px Arial; color: #006480;">Z przyjemnością informujemy ze przezentacja Twojej firmy<br /> z dnia na dzień zdobywa nowych klientów</span>
              </center>
              
              <center>  
                <table width="508" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td colspan="3">
                      <img src="{HOST}/gfx/m_gora.jpg" />
                    </td>
                  </tr>
                  <tr>
                    <td width="11"><img src="{HOST}gfx/m_lewa.jpg" /></td>
                    <td style="background: #fff;">
                      <table  cellpadding="4" style="width: 100%; padding: 10px; font: 14px Arial; color: #016481;" cellspacing="0">
                        <tr>
                        <th style="border-bottom: 1px solid #cfcfcf; text-align: left; color: #183557;">Okres</th>
                        <th style="border-bottom: 1px solid #cfcfcf; text-align: left; color: #183557;">Wyświetleń</th>
                        </tr>
                        <tr>
                        <td style="border-bottom: 1px solid #cfcfcf;">{first_month}</td>
                        <td style="border-bottom: 1px solid #cfcfcf;">{first_count}</td>
                        </tr>
                        <tr>
                        <td style="border-bottom: 1px solid #cfcfcf;">od początku</td>
                        <td style="border-bottom: 1px solid #cfcfcf;">{count}</td>
                        </tr>
                      </table>
                    </td>
                    <td width="11"><img src="{HOST}gfx/m_prawa.jpg" /></td>
                  </tr>            
                  <tr>
                    <td colspan="3">
                      <img src="{HOST}gfx/m_dol.jpg" />
                    </td>
                  </tr>
                </table> 	
              </center>	
              
              <center>              
                  <span style="font: 13px Arial; color: #006480;">Przejź na pakiet premium i zostań liderem swojej branzy <br /> to tylko 1 zł brutto dziennie</span>
              </center>

          </td>
        <td width="11"><img src="{HOST}gfx/n_prawa.jpg" /></td>
      </tr>
      <tr>		
        <td colspan="3">
          <img colspan="2" border="0" src="{HOST}gfx/n_dol.jpg" />
        </td>
      </tr>
      </table>
    </center>');
      return $html;
    }
    
}
