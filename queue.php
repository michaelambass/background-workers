<?php 
require 'src/BackgroundWorkers/BackgroundWorkers.php';
require 'src/BackgroundWorkers/Task.php';
use \BackgroundWorkers\BackgroundWorkers;

// set the destination
BackgroundWorkers::setConfiguration(array('uri_tasks' => 'http://localhost:8888/background-workers'));

// execute the queue
BackgroundWorkers::queue();
