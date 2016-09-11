<?php
/**
 * XXX: UWAGA! Ta klasa jest przestarzała! Lepsza wersja jest w CzasieAtrakcji,
 * sklepie, lub gdziekolwiek indziej! Zostawiam dla zachowania "wstecznej
 * kompatybilności", ale trzeba tu zajrzeć i ją zmienić!!!
 */
class T
{
    public static function getActionplace()
    {
      $sf_context = sfContext::getInstance();
      $action = $sf_context->getActionName();
      $module = $sf_context->getModuleName();
      $application =$sf_context->getConfiguration()->getApplication();

      $actionplace = $application . '|' . $module . '|' . $action;

      return $actionplace;
    }
    
    static function getMonth($month)
    {
        switch($month)
        {
            case '01' : return 'styczeń';
            case '02' : return 'luty';
            case '03' : return 'marzec';
            case '04' : return 'kwiecień';
            case '05' : return 'maj';
            case '06' : return 'czerwiec';
            case '07' : return 'lipiec';
            case '08' : return 'sierpień';
            case '09' : return 'wrzesień';
            case '10' : return 'październik';
            case '11' : return 'listpopad';
            case '12' : return 'grudzień';
        }
    }

    public static function isGood()
    {
      $sf_context = sfContext::getInstance();
      $action = $sf_context->getActionName();
      $module = $sf_context->getModuleName();
      $application =$sf_context->getConfiguration()->getApplication();

      $actionplace = $application . '|' . $module . '|' . $action;

      return $actionplace;
    }

    public static function makeDirs($path, $dir_names)
    {
      // $dir_names może być tablicą lub stringiem
      if (!is_array($dir_names)) {
        $dir_names = array($dir_names);
      }
      
      $directory = $path.'/';
      if (!is_readable($directory)) {
        mkdir($directory, 0777, true);
        chmod($directory, 0777);
      }

      foreach ($dir_names as $dir_name) {
        // tworzenie katalogu z miniaturami
        $directory = $path.'/'.$dir_name.'/';
        if (!is_readable($directory)) {
          mkdir($directory, 0777, true);
          chmod($directory, 0777);
        }
      }
    }


    /*
     * Rekursywny chmod
     */
    public static function chmod_R($path, $filemode) {

        $dh = opendir($path);
        while ($file = readdir($dh)) {
            if($file != '.' && $file != '..') {
                $fullpath = $path.'/'.$file;
          echo 'chmod ' .$filemode.' '.$fullpath. "<br />";
          chmod($fullpath, $filemode);
          echo '<br />';
                if(is_dir($fullpath)) {

                   self::chmod_R($fullpath, $filemode);

                }
            }
        }

        closedir($dh);
    }

    static public function dbFieldExists($table_name, $field_name)
    {
      $dsn = Doctrine_Manager::getInstance()->getCurrentConnection()->getOption('dsn');
      $temp = explode(':', $dsn);
      $connection_parameters = array();
      $options = explode (';', $temp[1]);
      foreach ($options as $option) {
        $keyval = explode ('=', $option);
        $key = $keyval[0];
        $val = $keyval[1];
        $connection_parameters[$key] = $val;
      }
      $db_name = $connection_parameters['dbname'];

      $sql = 'SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.$table_name.'" AND TABLE_SCHEMA = "'.$db_name.'" AND COLUMN_NAME = "'.$field_name.'"';

      $column_exist = (bool) Doctrine_Manager::getInstance()->getCurrentConnection()->execute($sql)->fetchAll();

      return $column_exist;
    }

    public static function cross_app_url_for($app, $route, $args=null)
    {
      $routing = new sfPatternRouting(new sfEventDispatcher());

      $config = new sfRoutingConfigHandler();
      $routes = $config->evaluate(array(sfConfig::get('sf_apps_dir').'/'.$app.'/config/routing.yml'));

      $routing->setRoutes($routes);

      $return = 'http://'.$_SERVER['SERVER_NAME'].$routing->generate($route, $args);
      return str_replace('http://admin.', 'http://', $return);
    }

    static public function dbTableExists($table_name) {
      return (bool) Doctrine_Manager::getInstance()->getCurrentConnection()->execute('SHOW TABLES LIKE "'.$table_name.'"')->fetchAll();
    }

    static public function url_for($route,$object = null)
    {
        if($object == null)
        {
            return sfContext::getInstance()->getController()->genUrl($route , $absolute = false );
        }
        else
        {
            return sfContext::getInstance()->getController()->genUrl( array(
                'sf_route' => $route,
                'sf_subject' => $object
            ));
        }
    }

    // linki absolutne
    static public function abs_url_for($route, $object = null, $lang = null)
    {
      if ($lang) {
        sfContext::getInstance()->getUser()->setCulture($lang);
      }

      $url = self::url_for($route, $object);

      if ($lang) {
        sfContext::getInstance()->getUser()->setCulture(Lang::getDefaultLanguage());
      }

      return self::getSiteNameUrl() . $url;
    }

    static public function redirect($route,$object = null)
    {
        $controller = sfContext::getInstance()->getController();
        if($object == null)
        {
            $controller->redirect($route);
        }
        else
        {
            $controller->redirect(array('sf_route'=>$route,'sf_subject'=>$object));
        }
    }

    static public function fileGetExtension($filename)
    {
        $tmp = explode('.',$filename);
        return $tmp[1];
    }

    static public function fileGetName($filename)
    {
        $tmp = explode('.',$filename);
        return $tmp[0];
    }

        static public function getFQDN()
        {
            $parts = array();
            $parts = explode('.',$_SERVER['SERVER_NAME'],2);
            if(($parts[0] == 'www') || ($parts[0] == 'admin'))
            {
                return $parts[1];
            }
            else
            {
                return $_SERVER['SERVER_NAME'];
            }
        }
        
	static public function getSiteNameUrl()
	{
                return 'http://'.self::getFQDN();
	}

        static public function getUrlToAdmin()
        {
            return 'http://admin.'.self::getFQDN();
        }

    static public function systemMail($to,$title,$content,$from = null, $file = 'mail.html')
    {
        //domyślny adres nadawcy
        $from = $from ? $from : Contact::getAdminEmail();

        //puts content into HTML
        $message = file_get_contents(dirname(__FILE__).'/'.$file);    //html file to send
//        $message = ereg_replace('{Title}',$title,$message); //title in content
//        $message = ereg_replace('{Content}',$content,$message); //message content
//        $message = ereg_replace('{MAIL_IMAGES_PATH}','http://'.$_SERVER['HTTP_HOST'].'/backend/mail',$message);    //path to pictures
        $message = preg_replace('/{Title}/',$title,$message); //title in content
        $message = preg_replace('/{Content}/',$content,$message); //message content
        $message = preg_replace('/{MAIL_IMAGES_PATH}/','http://'.$_SERVER['HTTP_HOST'].'/backend/mail',$message);    //path to pictures

        if(stgConfig::get('systemmail_type') == 'sendmail')  //jesli wysylka jest przez SENDMAILA
        {
            // To send HTML mail, the Content-type header must be set
            $headers = '';
            $headers  .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "From: ". $from . " <" . $from . ">\r\n";
            ini_set('sendmail_from', $from);
            mail($to, $title, $message, $headers); //mail command :)
        }

        if(stgConfig::get('systemmail_type') == 'smtp')  //jesli wysylka jest przez SMTP
        {
            $smtp = array();
            $smtp['host']   = stgConfig::get('smtp_host');
            $smtp['port']   =   stgConfig::get('smtp_port');
            //$smtp['port']   =   '25';
            //$smtp['port']   =   '587';
            $smtp['security']   =   (stgConfig::get('smtp_security') == 'null') ? null : stgConfig::get('smtp_security');
            $smtp['username']   =   stgConfig::get('smtp_username');
            $smtp['password']   =   stgConfig::get('smtp_password');

            //Create the Transport
            $transport = Swift_SmtpTransport::newInstance($smtp['host'], $smtp['port'],$smtp['security'])
            ->setUsername($smtp['username'])
            ->setPassword($smtp['password'])
            ;

            //Create the Mailer using your created Transport
            $mailer = Swift_Mailer::newInstance($transport);

            //Create a message
            $message = Swift_Message::newInstance($title)
            ->setFrom(array($from))
            ->setTo(array($to))
            ->setBody($message,'text/html','utf-8')
            ;
            //Send the message
            $result = $mailer->send($message);
        }
    }

    static public function generateRandomKey($len = 20)
    {
        $string = '';
        $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 1; $i <= $len; $i++)
        {
            $string .= substr($pool, rand(0, 61), 1);
        }
        return md5($string);
    }

    static public function du($dir)
    {
        $size = 0;
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file)
        {
            $size = $size + $file->getSize();
        }
        return $size;
    }

    /**
     * Returns dir's listing as array
     *
     * @param <type> $dir path to dir
     * @param <type> $except array with dirs that are not included in return, defaults to current dir, previous dir and .svn dir
     * in order to display all, provide empty array as second parameter
     * $all = T::ls('dir',array());
     * @return <type> return array
     */
    static public function ls($dir,$except = array('.','..','.svn'))
    {
        $dir_handle = @opendir($dir) or die('Unable to open '.$dir);

        $return = array();
        $counter = 0;
        while ($file = readdir($dir_handle))
        {
            if(empty($except))
            {
                $return[$counter] = $file;
                $counter++;
            }
            else
            {
                if(!in_array($file,$except))
                {
                    $return[$counter] = $file;
                    $counter++;
                }
            }
        }
        closedir($dir_handle);
        return $return;
    }

    static public function pr($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    static public function cc($app = 'backend')
    {
        $dir = sfConfig::get('sf_cache_dir').'/'.$app.'/';
        return self::destroy($dir);
//        return true;
    }


    //ulradłem z:
    //http://www.php.net/manual/pl/function.rmdir.php#91797
    static public function destroy($dir)
    {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!self::destroy($dir.DIRECTORY_SEPARATOR.$item)) return false;
        }
        return rmdir($dir);
    }
}

?>
