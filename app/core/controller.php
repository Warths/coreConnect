<?php

namespace App\Core;

use App\Core\Router;


class Controller {
    static function describe($route, $function_name, $methods=['GET']) {
        $router = Router::getRouter();
        $instance = new static();
        $router->addRoute($route, [$instance, $function_name], $methods);
    }
}