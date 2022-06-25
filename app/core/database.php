<?php

namespace App\Core;

class Database {
    protected $db;
    function __construct() {
        $host = $_ENV["DB_HOST"]; $name = $_ENV["DB_NAME"];
        $user = $_ENV["DB_USER"]; $pass = $_ENV["DB_PASS"];
        $this->db = new \PDO("mysql:host=$host;dbname=$name", $user, $pass);
    }
}