<?php 
require 'src/BackgroundWorkers/BackgroundWorkers.php';
use \BackgroundWorkers\BackgroundWorkers;

BackgroundWorkers::queue();

