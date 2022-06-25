<?php

namespace App\Core;

use App\Core\Router;


class Controller {
    static function describe($route, $callable) {
        $router = Router::getRouter();
        $router->addRoute($route, $callable);
    }
}