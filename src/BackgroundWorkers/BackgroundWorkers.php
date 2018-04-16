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
        'uri_tasks' => 'http://localhost:8888/background-workers'
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
        try {
                        
            // queue path not found
            if (!self::queuePathExist(self::$config['path_queue'])) {
                throw new \Exception('Queue path not reachable');
            }

            // get files from folder
            $files = scandir(self::$config['path_queue']);

            // loop each file
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {

                    // decompose file
                    $file_parts = explode('-', $file);

                    // decomposed part undefined
                    if (!isset($file_parts[0])) {
                        throw new \Exception('Queue filename is incorrect');
                    }

                    if (!isset($file_parts[1])) {
                        throw new \Exception('Queue filename is incorrect');
                    }

                    // execute based on execution time
                    if (intval($file_parts[0]) <= time()) {

                        // get the file content
                        $uri_task = (isset(self::$config['uri_tasks'])) ? self::$config['uri_tasks'] : false;

                        if (!$uri_task) {
                            throw new \Exception('URI task not found');
                        }

                        // get the task name
                        $task_name = str_replace('.php', '', $file_parts[1]);
                        
                        // task content
                        $task_content = file_get_contents(self::$config['path_queue'].'/'.$file);

                        // Note : To improve with multi curl instance

                        $ch = curl_init();
                        $url = $uri_task.'/'.$task_name.'/test.php';

                        
                        //set the url, number of POST vars, POST data
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 2);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, array('datas' => $task_content, 'queue_name' => $file));

                        //execute post
                        $result = curl_exec($ch);

                        //close connection
                        curl_close($ch);
                    }
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
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

    /**
     * set a task in the queue for a schedule time 
     *
     * @param string $name
     * @param resource $params
     * @param int $time
     * @return void
     */

    public static function setTaskSchedule($name, $params, $time)
    {
        self::registerTask($name, $params, $time);
    }

    /**
     * register a task
     *
     * @param string $task_name
     * @param resource $params
     * @param int $time
     * @return void
     */

    public static function registerTask($task_name, $params, $time)
    {
        try {
            // task file not found
            if (self::taskExist($task_name)) {
                throw new \Exception('Task file not found');
            }
            
            // time for schedule is in the past
            if ($time < time()) {
                throw new \Exception('Task schedule must be in future');
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
            
            $queue_path_without_extension = str_replace('.php', '', $queue_path);
            $queue_path = $queue_path_without_extension .'-'. uniqid().'.php';

        }

        try {

            // path_queue exist
            if (!file_exists(self::$config['path_queue'])) {
                throw new \Exception('Queue folder not reachable');
            }

            // create file
            return file_put_contents($queue_path, $serialized_params);
        } catch (Exception $e) {
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
