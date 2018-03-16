<?php 
/**
 * Background Workers
 *
 * @author Michaël Ambass <michael.ambass@gmail.com>
 * @package BackgroundWorkers
 */

namespace BackgroundWorkers;

/**
 * BackgroundWorkers
 */

class BackgroundWorkers
{

    // default and state configuration
    public static $config = array(
        'path_queue' => 'queues'
    );

    
    /**
     * class initialization
     *
     * @param Array $config
     */

    public static function init(array $config = array())
    {
        
        // set config
        self::setConfiguration($config);
    }

    /**
     * set configuration parameters
     *
     * @param Array $config
     */

    public static function setConfiguration(array $config)
    {

        // loop each new config
        foreach ($config as $parameter => $value) {

            // set the config parameter
            if (isset(self::$config[$parameter])) {
                self::$config[$parameter] = $value;
            }
        }
    }

    public static function queue()
    {
    }

    public static function setHook($name, $params, $delay = 0)
    {
    }

    public static function setSchedule($time, $name, $params)
    {
    }

    public static function fromHook($name, $path)
    {
    }

    public static function fromSchedule($time, $path)
    {
    }
}
