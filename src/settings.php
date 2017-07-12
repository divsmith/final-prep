<?php

// Settings
class Settings {
    protected $conf;

    public function __construct() {
        $this->setConf();
    }

    public function getConf() {
        return $this->conf;
    }

    public function setConf() {
        $this->conf = [
            "db" => [
                 "host" => "mysql",
                 "dbname" => "test",
                 "user" => "foo",
                 "pass" => "bar"
            ]
        ];
    }
}
