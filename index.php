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

    // config store 
    static $config;

    /**
     * initialization 
     *
     * @return void
     */

    static public function init(Array $config = array()){

        // set config vars
        self::$config = $config;

    }

    
}

// errors display for plugin creation
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// testing case 
BackgroundWorkers::init(array(

));