<?php 
require 'vendor/autoload.php';
use \BackgroundWorkers\BackgroundWorkers;

BackgroundWorkers::queue();

