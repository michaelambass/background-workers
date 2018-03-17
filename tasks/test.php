<?php 
require '../vendor/autoload.php';
use \BackgroundWorkers\Task;

/**
 * Demo task 
 */
$task = new Task('test');

error_log('executed test.php');


// task executed
$task->executed();