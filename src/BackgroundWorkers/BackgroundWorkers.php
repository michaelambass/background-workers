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
        self::registerTask($name, $params, $time);
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

    public static function registerTask($task_name, $params, $time)
    {
        try {
            // task file not found
            if (self::taskExist($task_name)) {
                throw new Exception('Task file not found');
            }
            
            // time for schedule is in the past
            if ($time < time()) {
                throw new Exception('Task schedule must be in future');
            }

            // serialize the params
            $serialized_params = serialize($params);

            // create the queue file
            self::registerQueue($task_name, $serialized_params, $time);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * register queue file in queue folder
     *
     * @param string $task
     * @param resource $serialized_params
     * @param int $time
     * @return bool
     */
    
    public static function registerQueue($task, $serialized_params, $time)
    {

        // generate the queue path
        $queue_path = self::$config['path_queue'].'/'.$time.'-'.self::taskNameFormatting($task).'.php';

        // check if queue path already exist
        if (self::queuePathExist($queue_path)) {
            $queue_path = $queue_path + uniqid();
        }

        try{

            // path_queue exist 
            if(!file_exists(self::$config['path_queue'])){
                throw new Exception('Queue folder not reachable');
            }

            // create file
            return file_put_contents($queue_path, $serialized_params);

        } catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * check if queue path already exist
     *
     * @param string $path
     * @return bool
     */

    public static function queuePathExist($path)
    {
        return (file_exists($path));
    }

    /**
     * formatting the task name to match in any case
     *
     * @param string $name
     * @return string
     */

    public static function taskNameFormatting($name)
    {
        return trim(str_replace(' ', '', strtolower($name)));
    }

    /**
     * check if the task exist
     *
     * @param string $name
     * @return bool
     */

    public static function taskExist($name)
    {

        // formatting task name
        $task = self::taskNameFormatting($name);

        // task path
        $task_path = self::$config['path_tasks'].'/'.$task;

        // check if task file exist
        return file_exists($task_path);
    }
}
