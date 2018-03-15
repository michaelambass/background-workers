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

class BackgroundWorkers{

    // default and state configuration
    static $config = array(
        'path_queue' => 'queue',
        'path_jobs' => 'jobs' 
    );

    
    /**
     * class initialization
     *
     * @param Array $config
     */

    static public function init(Array $config = array()){

        // set config
        self::setConfiguration($config);

    }

    /**
     * set configuration parameters
     *
     * @param Array $config
     */

    static public function setConfiguration(Array $config){

        // loop each new config 
        foreach($config as $parameter => $value){

            // set the config parameter 
            if(isset(self::$config[$parameter])){
                self::$config[$parameter] = $value;
            }
        }
    }

}

// errors display for plugin creation
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// testing case 
BackgroundWorkers::init(array());

// BackgroundWorkers::setHook('NAME', array('param' => 'value'));
// BackgroundWorkers::setSchedule(time, 'NAME', array('param' => 'value'));
// BackgroundWorkers::fromHook('NAME', 'path');
// BackgroundWorkers::fromSchedule(time, 'path');