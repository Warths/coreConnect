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
        $this->logger = new Logger("Logger");
        $this->logger->discrete("Bonjour");
        $this->logger->debug("Bonjour");
        $this->logger->info("Bonjour");
        $this->logger->warning("Bonjour");
        $this->logger->error("Bonjour");


    }

    function serve() {
        // SOME MAGIC HAPPENS HERE
    }
}

