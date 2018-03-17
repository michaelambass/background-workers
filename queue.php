<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use \BackgroundWorkers\BackgroundWorkers;

// set the destination 
BackgroundWorkers::setConfiguration(array('uri_tasks' => 'http://localhost:8888/background-workers'));

// execute the queue
BackgroundWorkers::queue();