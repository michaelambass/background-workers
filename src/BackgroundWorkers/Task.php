<?php 
namespace BackgroundWorkers;

/**
 * Task class from BackgroundWorkers
 * 
 * manage the task execution state 
 */

class Task
{

    // task name 
    public $name;

    // task datas 
    public $datas;

    // queue name
    public $queue;

    /**
     * set the task
     *
     * @param string $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->datas = (isset($_POST['datas'])) ? $_POST['datas'] : false;
        $this->queue = (isset($_POST['queue_name'])) ? $_POST['queue_name'] : false;
    }

    /**
     * task executed
     *
     * @return void
     */

    public function executed()
    {

        // generate task file path 
        $taskPath = \BackgroundWorkers\BackgroundWorkers::$config['path_queue'].'/'.$this->queue;
                
        try{

            // check if the file path exist 
            if(!file_exists($taskPath)){                
                throw new Exception('Task not found');
            }

            // remove the file
            unlink($taskPath);

        } catch(Exception $e){
            error_log($e->getMessage());
        }
        
    }

}
