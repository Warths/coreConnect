<?php

namespace App\Core;

use App\Core\Database;

class Model extends Database {
    protected $table;

    function byId($id) {
        $this->fetch("SELECT * FROM $this->table WHERE id = ?", [$id]);
    }
}