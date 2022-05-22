<?php

namespace App\Core;

use App\Core\Environment;
use App\Core\Logger;
use App\Core\Request;

class CoreConnect {
    private $env;

    function __construct() {
        // Setting env up
        $this->env = new Environment();

        // Configuring logging.
        $this->logger = new Logger("Logger");


    }

    function serve() {
        // STARTING SERVING CLIENT
        
        $client = $_SERVER["REMOTE_ADDR"] . ":" . $_SERVER["REMOTE_PORT"];
        $this->logger->discrete(
            "Received request from " . $client
        );

        $request = new Request();
        // END SERVING CLIENT 
        $this->logger->discrete(
            "Served ".$client." in ".$request->serveTime(). "ms."
        );
    }
}

