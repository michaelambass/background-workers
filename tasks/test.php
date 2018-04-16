<?php 
require '../src/BackgroundWorkers/BackgroundWorkers.php';
require '../src/BackgroundWorkers/Task.php';
use \BackgroundWorkers\Task;
use \BackgroundWorkers\BackgroundWorkers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Demo task
 *
 * @description     Task description
 */

 BackgroundWorkers::init(array(
     'path_queue' => '../tasks/queues'
 ));

// instanciate the task
$task = new Task('test');

// getting datas
$datas = $task->datas;

// insert your code here...

// task executed
$task->executed();
