<?php

namespace App\Core;

use App\Core\Router;

class Request {
    private $logger;

    public function __construct() {
        $this->logger = new Logger($this->clientName());
        $this->logger->discrete("Handling Request");
        $this->route();
    }

    public function route() {
        $router = Router::getRouter();
        $router->serve();
    }

    public function __destruct() {
        $this->logger->discrete(
          "Served in ".$this->serveTime(). "ms."
        );

    }

    public function clientName() {
        return $_SERVER["REMOTE_ADDR"] . ":" . $_SERVER["REMOTE_PORT"];
    }

    private function serveTime() {
        return intval(microtime(true)*1000-$_SERVER["REQUEST_TIME_FLOAT"]*1000);
    }

}