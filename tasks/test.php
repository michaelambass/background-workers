<?php 
require '../vendor/autoload.php';
use \BackgroundWorkers\Task;

/**
 * Demo task
 *
 * @description     Task description
 */

// instanciate the task
$task = new Task('test');

// getting datas
$datas = $task->datas;

// insert your code here...

// task executed
$task->executed();
