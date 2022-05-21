<?php

namespace App\Core;

use App\Core\Environment;
use App\Core\Logger;

class CoreConnect {
    private $env;

    function __construct() {
        // Setting env up
        $this->env = new Environment();

        // Configuring logging.
        $this->logger1 = new Logger("Logger 1");
        $this->logger2 = new Logger("Logger 2");
        $this->logger1->log("Bonjour");
        $this->logger2->log("ORVOUAR");
        

    }

    function serve() {
        // SOME MAGIC HAPPENS HERE
    }
}

