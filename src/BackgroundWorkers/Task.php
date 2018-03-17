<?php 
namespace BackgroundWorkers;

class Task
{
    var $name;

    public function __constructor($name){
        $this->name = $name;
    }

    public function executed(){
        echo 'Executed';
    }
}