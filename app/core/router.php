<?php

namespace App\Core;

use App\Core\Route;

class Router {
    static $instance = null;
    private $routes = [];

    public function serve() {
        foreach($this->routes as $route) {
            $params = $route->match();
            if ($params) {
                // SERVE
                call_user_func($route->callable, [$params]);
            }
            
            if (isset($_ENV["REST_ONLY"]) && $_ENV["REST_ONLY"] == "1") {
                
            }
        } 
    }

    public function addRoute($pattern, $callable) {
        $route = new Route($pattern, $callable);
        $this->routes[] = $route;
    }

    static function getRouter() {
        if (self::$instance == null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

}