<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Toolsclass
 *
 * @author kaliban
 */
class Tools
{

    static public $f = false; // czy otwarty jest kolejny poziom menu (tylko przy wyświetlaniu komponentu submenu, musi byc jakos zmienna statyczna)
    static public $breadcrumbs_first = true;
    static public $parent_id = 0;

    /*
     * Ukradłem z: http://groups.google.com/group/doctrine-user/msg/36271ca1b5127f10
     * (zmodyfikowane)
    */
    static public function Get_Array_Keys_UL($object, $active = false, $method='prepareLink', $only_if_object_is_active = false)
    {
        $recursion = __FUNCTION__;
        $out = '';
        if ($only_if_object_is_active)
        {
            if ($object->getIsActive())
            {
                $out .= $return = ($object->getNode()->getLevel() > 0) ? self::$method($object, $active) : '';
                if ( $object->getNode()->hasChildren()) // TODO: powinno być zaimplementowane hasActiveChildren, bo jesli sa dzieci, ale nieaktywne to tworzy się puste <ul></ul>

                {
                    $out .= sprintf("<ul>");
                    foreach($object->getNode()->getChildren() as $child)
                    {
                        $out .= self::$recursion($child, $active, $method, $only_if_object_is_active);
                    }
                    $out .= sprintf("</ul>");
                }
                $out .= ($object->getNode()->getLevel() > 0) ? "</li>" : '';
            }
        }
        return $out;
    }

    static public function Get_Array_Keys_UL2($object, $active = false, $method='prepareLink')
    {
        $recursion = __FUNCTION__;
        $out = '';
        $out .= $return = ($object->getNode()->getLevel() > 1) ? self::$method($object, $active) : '';
        if ( $object->getNode()->hasChildren())
        {
            $out .= sprintf("<ul>");

            foreach($object->getNode()->getChildren() as $child)
            {
                $out .= self::$recursion($child, $active, $method);
            }
            $out .= sprintf("</ul>");

        }
        $out .= ($object->getNode()->getLevel() > 1) ? "</li>" : '';

        return $out;
    }

    static public function getSubMenu($root, $active = false)
    {

        return self::Get_Array_Keys_UL2($root, $active);
    }

    static private function getParentMenuId($object)
    {
        $parent_id = 0;
        if($object->getLevel() == 1)
        {
            $parent_id = $object->getPrimaryKey();
        }
        else
        {
            do
            {
                $object = $object->getNode()->getParent();
                $level = $object->getLevel();
            } while($level != 1);
            $parent_id = $object->getPrimaryKey();
        }
        return $parent_id;
    }


    static public function prepareLink($node, $active = false, $return_html = true)
    {
        
      $modelRoute = explode(':',$node->getModel());
      $css = '';
      if($node->getCssclass()!=='empty') {
        $css = $node->getCssclass();
      }

      if($modelRoute[0] != 'route')
      {
          
        if(($node->getRoute() === 'false') || ($node->getModel() === 'false') || ($node->getObject() === 0))    //Zwykły link
        {
          $link = sprintf('<li><a %s href="%s" title="%s" target="%s"><span>%s</span></a>', ($node->getCssclass()!=='empty')?'class="'.$node->getCssclass().'"':'',$node->getUrl(),$node->getTitle(),$node->getTarget(),$node->getName());
        }
        else    //Link do modułu
        {
          $model = $node->getModel();
          $tmp = explode(':', $model);
          $model = $tmp[0];
//          $temp_empty_object = new $model();
//          $object = null;
//          if ($temp_empty_object->hasColumn('record_key')) {
//            $object = Doctrine::getTable($model)->findByRecordKey($node->getObject());
//          }
//          if (!$object) {
            $object = Doctrine::getTable($model)->find($node->getObject());
//          }
//          $url = url_for($node->getRoute(), $object);
          $url = T::url_for($node->getRoute(), $object);
          $act = '';
          $li_active = '';
          //echo $active.' ********* '.$url.'<br />';
          if($active === $url)
          {
              
            $act = 'active ';
            $li_active = 'class="li_active"';

            sfConfig::add($param = array('parent_link' => self::getParentMenuId($node)));
            sfConfig::add($param = array('current_link' => $node->getId()));
            
          }
          $class = $act.$css;
          if(!empty($class)) $class = 'class="'.$class.'"';
          #$link = sprintf('<li><a %s href="%s" title="%s" target="%s"><span>%s</span></a>', ($node->getCssclass()!=='empty')?'class="'.$node->getCssclass().'"':'',url_for($node->getRoute(),Doctrine::getTable($node->getModel())->find($node->getObject())),$node->getTitle(),$node->getTarget(),$node->getName());

          if ($return_html) {
            $link = sprintf('<li id="link-%s" %s><a %s href="%s" title="%s" target="%s"><span>%s</span></a>',$node->getId(), $li_active, $class,$url,$node->getTitle(),$node->getTarget(),$node->getName());
          }
          else {
            $link = T::getSiteNameUrl() . $url;
          }
        }
      }
      else
      {
//        $url = url_for($modelRoute[1]);
        $url = T::url_for($modelRoute[1]);
        $act = '';
        $li_active = '';
        if($active === $url)
        {
          $act = 'active ';
          $li_active = 'class="li_active"';
          sfConfig::add($param = array('parent_link' => self::getParentMenuId($node)));
          sfConfig::add($param = array('current_link' => $node->getId()));

        }
        $class = $act.$css;
        if(!empty($class)) $class = 'class="'.$class.'"';

        if ($return_html) {
          $link = sprintf('<li id="link-%s" %s><a %s href="%s" title="%s" target="%s"><span>%s</span></a>',$node->getId(), $li_active, $class,$url,$node->getTitle(),$node->getTarget(),$node->getName());
        }
        else {
          $link = T::getSiteNameUrl() . $url;
        }
      }

      return $link;
    }

    static function getBreadcrumbs($object, $method='prepareLink')
    {
        $recursion = __FUNCTION__;
        $out = '';
        if(self::$breadcrumbs_first ==  true)
        {
            $split = '';
            self::$breadcrumbs_first = false;
        }
        else
        {
            $split = '<span class="split">/</span></li>';
        }

        $out = self::$method($object).$split.$out;

        if ( $object->getNode()->hasParent() && $object->getNode()->getLevel() > 1)
        {
            $parent = $object->getNode()->getParent();
            $out = self::$recursion($parent, $method).$out;
        }
        return $out;
    }

    static private function prepareFile($node)
    {
        $link = sprintf('<li><a href="%s" title="%s" target="_self"><span>%s</span><img class="file_ico" src="%s"></a>', url_for('files_show',$node),$node->getDescription(),$node->getName(),$node->getFileIco());
        return $link;
    }

    static private function prepareProductscategories($node)
    {
        //echo url_for('productscategories',$node);
        //echo $node->getPrimaryKey();
        $link = sprintf('<li><a href="%s" title="%s" target="_self"><span>%s</span></a>', url_for('productscategories',$node),$node->getName(),$node->getName());
        return $link;
    }


    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }


    /**
     *  Guilerme Cośtam
     * http://groups.google.com/group/doctrine-user/browse_thread/thread/8674c5f27de54e0c
     */
    static public function toHierarchy($collection)
    {
        // Trees mapped
        $trees = array();
        $l = 0;

        if (count($collection) > 0)
        {
            // Node Stack. Used to help building the hierarchy
            $stack = array();

            foreach ($collection as $node)
            {
                $item = $node;
                $item['children'] = array();

                // Number of stack items
                $l = count($stack);

                // Check if we're dealing with different levels
                while($l > 0 && $stack[$l - 1]['level'] >= $item['level'])
                {
                    array_pop($stack);
                    $l--;
                }

                // Stack is empty (we are inspecting the root)
                if ($l == 0)
                {
                    // Assigning the root node
                    $i = count($trees);
                    $trees[$i] = $item;
                    $stack[] = & $trees[$i];
                } else
                {
                    // Add node to parent
                    $i = count($stack[$l - 1]['children']);
                    $stack[$l - 1]['children'][$i] = $item;
                    $stack[] = & $stack[$l - 1]['children'][$i];
                }
            }
        }

        return $trees;
    }

    static function getValueKey($id)
    {
        //$obj = Doctrine::getTable('Keys')->findOneByKeyName($id);
        $obj = stgConfig::get($id);
        if($obj)
        {
            return $obj;
        }
        else
        {
            return false;
        }
    }

    static function getGoogleMapsValueKey($id)
    {
        $domain = str_replace('.', '_', $_SERVER['SERVER_NAME']);
        $tmp = stgConfig::get('google_maps_'.$domain);
        if($tmp)
        {
            return $tmp;
        }
        
        $obj = stgConfig::get($id);
        if($obj)
        {
            return $obj;
        }
        else
        {
            return false;
        }
    }

    static function repair_entities ($html)
    {
      $html = str_replace('&oacute;', 'ó', $html);

      return $html;
    }
    
    static function br2space($string)
    {
      /* Changing all <br> types into spaces */
      $string = preg_replace('/<br[^>]*>/',' ',$string);

      /* Avoiding double spaces */
      $string = preg_replace('/[\ ]+/',' ',$string);

      return $string;
    }

    static function substrText($original_text, $max = 100, $sufix = '...')
    {
        $text = self::br2space($original_text);
        $text = strip_tags($text);

        $word = explode(' ', substr($text, $max));

        if (strlen($text) > $max) {
          $text = substr($text, 0, $max);
        }
        else {
          $sufix = '';
        }

        $result = trim($text . $word[0]) . $sufix;

        return $result;
    }

    //XXX NEW - http://192.168.1.200:9999/strony_forbegin/ticket/2
    static function substrws ( $html, $length = 180, $dots = "..." )
    {
$html = self::repair_entities($html);

$dots = strlen($html) > $length ? $dots : '';
        $snippet = substr ( $html, 0, $length );
        $snippet = strrpos ( $snippet, "<" ) > strrpos ( $snippet, ">" ) ? rtrim ( substr ( $html, 0, strrpos ( $snippet, "<" ) ) ) . $dots : rtrim ( $snippet ) . $dots;

        $html = $snippet;
        #put all opened tags into an array
        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
        $closedtags = $result[1];
        $len_opened = count ( $openedtags );
        # all tags are closed
        if( count ( $closedtags ) == $len_opened )
        {
            return $html;
        }
        $openedtags = array_reverse ( $openedtags );
        # close tags
        for( $i = 0; $i < $len_opened; $i++ )
        {
            if ( !in_array ( $openedtags[$i], $closedtags ) )
            {
                $html .= "</" . $openedtags[$i] . ">";
            }
            else
            {
                unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
            }
        }
        return $html;
    }

    //XXX DEPRECATED - http://192.168.1.200:9999/strony_forbegin/ticket/2
    static function substrws_OLD( $text, $len=180 )
    {
        if( (strlen($text) > $len) )
        {
            $whitespaceposition = strpos($text," ",$len)-1;
            if( $whitespaceposition > 0 )
                $text = substr($text, 0, ($whitespaceposition+1));
            // close unclosed html tags
            if( preg_match_all("|<([a-zA-Z]+)>|",$text,$aBuffer) )
            {
                if( !empty($aBuffer[1]) )
                {
                    preg_match_all("|</([a-zA-Z]+)>|",$text,$aBuffer2);
                    if( count($aBuffer[1]) != count($aBuffer2[1]) )
                    {
                        foreach( $aBuffer[1] as $index => $tag )
                        {
                            if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag)
                                $text .= '</'.$tag.'>';
                        }
                    }
                }
            }
        }
        return $text;
    }
    /**
     *  odfiltrowuje od tablicy $ids elementy nie będące (int)
     */
    static public function filterIds($ids)
    {
        $filtered_ids = array();
        foreach ($ids as $key => $id)
        {
            if ((int) $id)
            {
                $filtered_ids[] = (int) $id;
            }
        }
        return $filtered_ids;
    }

    /**
     * Zwraca transport SMTP ze Swifta skonfigurowany wg danych z SuperConfiga
     * @return Swift_SmtpTransport
     */
    static public function getSMTP()
    {
        $smtp = new Swift_SmtpTransport(Tools::getValueKey('smtp_host'), Tools::getValueKey('smtp_port'));
        $smtp->setUsername(Tools::getValueKey('smtp_username'));
        $smtp->setPassword(Tools::getValueKey('smtp_password'));

        return $smtp;
    }

    static public function checkEmail($email)
    {
        if (eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email))
        {
           return false;
        }
        else
        {
            return true;
        }
    }

    static public function array_in_array($array_small, $array_big)
    {
      $return = true;
      foreach ($array_small as $array_small_element) {
        if (!in_array($array_small_element, $array_big)) {
          $return = false;
        }
      }
      return $return;
    }

}
?>
