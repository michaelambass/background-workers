<?php 
require '../vendor/autoload.php';
use \BackgroundWorkers\Task;

/**
 * Demo task 
 */
$task = new Task('test');


// task executed
$task->executed();