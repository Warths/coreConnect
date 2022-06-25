<?php

namespace App\Core;

use App\Core\Logger;

class Route {
    function __construct($pattern, $callable) {
        $this->pattern = $pattern;
        if (substr($this->pattern, -1) != "/") {
            $this->pattern .= "/";
        }

        $this->callable = $callable;
        $this->logger = new Logger($this->pattern);
    }

    function match() {
        $client_pattern = self::get_client_pattern();

        $rest_params = [];

        $client_pattern = explode("/", $client_pattern);
        $route_pattern = explode("/", $this->pattern);

        // Splitting route into multiple parts
        if (count($client_pattern) != count($route_pattern)) {
            return false;
        }

        // Checking if all parts match, or is a parameter
        for ($i = 0; $i<count($client_pattern); $i++) {
            if ($client_pattern[$i] == $route_pattern[$i]) {
                continue;
            } 

            // No match, is this a rest param ? 
            if ($this->is_rest_param($route_pattern[$i])) {
                $name = $this->get_param_name($route_pattern[$i]);
                $rest_params[$name] = $client_pattern[$i];
            // No? then it's not this route.
            } else {
                return false;
            }
            
        }

        return $rest_params;
    }

    static function is_rest_param($param) {
        return substr($param, 0, 1) == "{" && substr($param, -1) == "}";
    }

    static function get_param_name($param) {
        return substr($param, 1, -1);
    }

    static function get_client_pattern() {
        $client_route = $_SERVER["REDIRECT_URL"];
        if (substr($client_route, -1) != "/") {
            $client_route .= "/";
        }
        $prefix = self::get_server_route_prefix();
        return substr($client_route, strlen($prefix), strlen($client_route));

    }

    static function get_server_route_prefix() {
        $php_self = $_SERVER["PHP_SELF"];
        return str_replace("/index.php", "", $php_self);
    }
}