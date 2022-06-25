<?php
namespace App\Src\Models;

use App\Core\Model; 

class CommandRepository extends Model {
    protected $table = "commands";

    function getByCommand($command) {
        return $this->fetch("SELECT * FROM $this->table WHERE command = ?", [$command]);
    }
}
