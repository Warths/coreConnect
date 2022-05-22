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
        $this->logger = new Logger("Core");
        


    }

    function serve() {
        // STARTING SERVING CLIENT
        $request = new Request();
        // END SERVING CLIENT 
    }
}

