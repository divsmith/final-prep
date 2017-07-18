<?php

namespace Domain;

class Task {
    protected $id; 
    protected $task;
    protected $status;
    protected $createdDTTM;

    public function __construct() {}

    public function ID($id) {
        $this->id = $id;
        return $this;
    }

    public function Task($task) {
        $this->task = $task;
        return $this;
    }

    public function Status($val) {
        $this->status = $val;
        return $this;
    }

    public function CreatedDTTM($val) {
        $this->createdDTTM = $val;
        return $this;
    }
}
//  $obj = new Task();
//  $obj->ID(mysqlID)
//      ->Task(mysqlTask)
//      ->Status(mysqlStatus);
