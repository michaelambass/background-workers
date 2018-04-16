<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'src/BackgroundWorkers/BackgroundWorkers.php';
require 'src/BackgroundWorkers/Task.php';
use \BackgroundWorkers\BackgroundWorkers;

// initialization
BackgroundWorkers::init(array());

// StdClass for test
$object = new \StdClass();

for($i = 0; $i <= 10; $i++){

    BackgroundWorkers::setTask('tasks', $object, '1');

    echo $i;
}

// set a queue
// BackgroundWorkers::setTask('test', $object);

// BackgroundWorkers::queue();
// BackgroundWorkers::setTask('NAME', array('param' => 'value'), $delay);
// BackgroundWorkers::setSchedule(time, 'NAME', array('param' => 'value'));
// BackgroundWorkers::fromHook('NAME', 'path');
// BackgroundWorkers::fromSchedule(time, 'path');
