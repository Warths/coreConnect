<?php

namespace App\Core;

use App\Core\Database;

class Model extends Database {
    protected $table;

    function byId($id) {
        return $this->fetch("SELECT * FROM $this->table WHERE id = ?", [$id]);
    }

    function all() {
        return $this->fetchAll("SELECT * FROM $this->table");
    }
}