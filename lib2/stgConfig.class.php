<?php
class stgConfig
{

    static public function getGroup($name)
    {
        return SuperConfig::getByScope($name);
    }
    /**
     * Retrieves a config parameter.
     *
     * @param string $name    A config parameter name
     * @param mixed  $default A default config parameter value
     *
     * @return mixed A config parameter value, if the config parameter exists, otherwise null
     */
    static public function get($name, $default = null)
    {
        $value = SuperConfig::getSettingValue($name);
        if($value == null)
        {
            $return = $default;
        }
        else
        {
            switch($value)
            {
                case 'on':
                    $return = true;
                    break;
                case 'true':
                    $return = true;
                    break;
                case 'false':
                    $return = false;
                    break;
                case 'off':
                    $return = false;
                    break;
                default:
                    $return = $value;
                    break;
            }
        }
        return $return;
    }

    /**
     * Retrieves all configuration parameters.
     *
     * @return array An associative array of configuration parameters.
     */
    static public function getAll()
    {
        return SuperConfig::getAll();
    }

    /**
     * Sets an array of config parameters.
     *
     * If an existing config parameter name matches any of the keys in the supplied
     * array, the associated value will be overridden.
     *
     * @param array $parameters An associative array of config parameters and their associated values
     */
    static public function add($parameters, $scope = false, $for_user = false)
    {
        foreach($parameters as $setting => $value)
        {
            $superConfig = SuperConfig::findByName($setting);
            $config = ($superConfig) ? $superConfig : new SuperConfig();
            $config->setSetting($setting);
            $config->setValue($value);
            if($scope)
            {
                $config->setScope($scope);
            }
            $config->setIsEnabledForUsers($for_user);
 
            $config->save();
        }
    }
}

?>
