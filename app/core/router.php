<?php

namespace App\Core;

use App\Core\Route;

class Router {
    static $instance = null;
    private $routes = [];

    public function serve() {
        foreach($this->routes as $route) {
            $params = $route->match();
            var_dump($params);
            if ($params) {
                echo "Ca match !";
            } else {
                echo "ca match po";
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