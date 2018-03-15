<?php 
require 'src/BackgroundWorkers/BackgroundWorkers.php';
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
BackgroundWorkers::setHook('test', $object);

// BackgroundWorkers::queue();
// BackgroundWorkers::setHook('NAME', array('param' => 'value'));
// BackgroundWorkers::setSchedule(time, 'NAME', array('param' => 'value'));
// BackgroundWorkers::fromHook('NAME', 'path');
// BackgroundWorkers::fromSchedule(time, 'path');
