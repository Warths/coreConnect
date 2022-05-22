<?php

namespace App\Core;

class Request {
    private $logger;

    public function __construct() {
        $this->logger = new Logger($this->clientName());
        $this->logger->discrete("Handling Request");
        
    }

    public function __destruct() {
        $this->logger->discrete(
          "Served in ".$this->serveTime(). "ms."
        );
    }

    public function get($key) {
        var_dump($_GET);
    } 

    public function clientName() {
        return $_SERVER["REMOTE_ADDR"] . ":" . $_SERVER["REMOTE_PORT"];
    }

    private function serveTime() {
        return intval(microtime(true)*1000-$_SERVER["REQUEST_TIME_FLOAT"]*1000);
    }

}