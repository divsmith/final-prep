<?php

namespace Domain;

class TaskBuilder {
    protected $object; 
    protected $id; 
    protected $task;
    protected $status;
    protected $createdDTTM;

    public function __construct() {
        $this->object = new Task();
    }

    public function Build() {
        return $this->object;
    }

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
