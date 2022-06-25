<?php

namespace App\Core;

use App\Core\Route;
use App\Core\Response\HttpResponse;
use App\Core\Response\JsonResponse;
use App\Core\Response\Generics;

class Router {
    static $instance = null;
    private $routes = [];

    public function serve() {
        $rest_only = isset($_ENV["REST_ONLY"]) && $_ENV["REST_ONLY"] == "1";

        foreach($this->routes as $route) {
            $params = $route->match();
            if (gettype($params) == "array") {
                $response = call_user_func($route->callable, $params);
                if (is_a($response, HttpResponse::class)) {
                    $response->render();
                    return;
                }
                
                // No Http Response ?
                $rest_only ?
                    (new JsonResponse(...Generics::json500))->render(): 
                    (new HttpResponse(...Generics::http500))->render();
                return;
            } 
        }

        $rest_only ?
            (new JsonResponse(...Generics::json404))->render(): 
            (new HttpResponse(...Generics::http404))->render();
    }

    public function addRoute($pattern, $callable, $methods) {
        $route = new Route($pattern, $callable, $methods);
        $this->routes[] = $route;
    }

    static function getRouter() {
        if (self::$instance == null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

}