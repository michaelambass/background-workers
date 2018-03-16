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
        'path_tasks' => 'tasks',
        'path_queue' => 'tasks/queues',        
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

    /**
     * set a task in queue
     *
     * @param string $name  name of the task to be executed
     * @param resource $params  datas to send to the task
     * @param integer $delay    delay before task execution
     * @return void
     */
    public static function setTask($name, $params, $delay = 0)
    {
        // generate the delay to execute
        $time = time() + $delay;

        // register the task
        self::registerTask($name, $time);

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

    static public function registerTask($name, $time){

        
    }

}
