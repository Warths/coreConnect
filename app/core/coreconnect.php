<?php

namespace App\Core;

use App\Core\Environment;
use App\Core\Logger;
use App\Core\Request;
use App\Core\Routing;

class CoreConnect {
    private $env;

    function __construct() {
        // Setting env up
        $this->env = new Environment();
        $this->env->load();

        $this->loadControllers();
        // Configuring logging.
        $this->logger = new Logger("Core");
        


    }

    private function loadControllers() {
        $ctrl_path = __DIR__."/../src/controllers/";
        $controllers = scandir($ctrl_path);
        foreach($controllers as $controller) {
            if (is_file($ctrl_path.$controller)) {
                require $ctrl_path.$controller;
            }
        }
    }

    public function serve() {
        // STARTING SERVING CLIENT
        $request = new Request();
        // END SERVING CLIENT 
    }
}

