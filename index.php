<?php 
require 'vendor/autoload.php';
use \BackgroundWorkers\BackgroundWorkers;

// errors display for plugin creation
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// testing case
BackgroundWorkers::init(array());

// StdClass for test
$object = new \StdClass();

// set a queue
// BackgroundWorkers::setTask('test', $object);

// BackgroundWorkers::queue();
// BackgroundWorkers::setTask('NAME', array('param' => 'value'), $delay);
// BackgroundWorkers::setSchedule(time, 'NAME', array('param' => 'value'));
// BackgroundWorkers::fromHook('NAME', 'path');
// BackgroundWorkers::fromSchedule(time, 'path');