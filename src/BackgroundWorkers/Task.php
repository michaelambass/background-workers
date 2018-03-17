<?php 
namespace BackgroundWorkers;

class Task
{
    public $name;
    public $datas;
    public $queue;

    public function __constructor($name)
    {
        $this->name = $name;
        $this->datas = (isset($_POST['datas'])) ? $_POST['datas'] : false;
        $this->queue = (isset($_POST['queue_name'])) ? $_POST['queue_name'] : false;
    }

    public function executed()
    {
        unlink(\BackgroundWorkers\BackgroundWorkers::$config['path_queue'].'/'.$this->queue);
        
        error_log('executed');
    }
}
