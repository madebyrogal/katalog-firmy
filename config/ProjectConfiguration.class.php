<?php
require_once dirname(__FILE__).'/../lib2/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    static protected $zendLoaded = false;

    static public function registerZend()
    {
        if (self::$zendLoaded)
        {
            return;
        }

        set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
        require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader/Autoloader.php';
        Zend_Loader_Autoloader::getInstance();
        self::$zendLoaded = true;
    }

    public function setup()
    {
      //echo sfConfig::get('sf_lib_dir');
      sfConfig::set('sf_lib_dir', '/lib2');

      $this->enableAllPluginsExcept(array('sfPropelPlugin'));
      $this->enablePlugins('csDoctrineActAsSortablePlugin');
      $this->enablePlugins('sfWebBrowserPlugin');
  }


  static public function getApplicationConfiguration($application, $environment, $debug, $rootDir = null, sfEventDispatcher $dispatcher = null)
  {
    $class = $application.'Configuration';

    if (null === $rootDir)
    {
      $rootDir = self::guessRootDir();
    }

//$rootDir = '/home/wojtek/NetBeansProjects/sell4_cafesilesia';
    if (!file_exists($file = $rootDir.'/apps/'.$application.'/config/'.$class.'.class.php'))
    {
      throw new InvalidArgumentException(sprintf('The application "%s" does not exist.', $application));
    }

    require_once $file;

    return new $class($environment, $debug, $rootDir, $dispatcher);
  }

}
