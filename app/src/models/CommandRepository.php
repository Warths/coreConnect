<?php
namespace App\Src\Models;

use App\Core\Model; 

class CommandRepository extends Model {
    protected $table = "commands";

    function get_by_command($command) {
        return $this->fetch("SELECT * FROM $this->table WHERE command = ?", [$command]);
    }

    function add_command($command, $description, $heading, $cooldown) {
        return $this->query("INSERT INTO $this->table 
                                 (id, command, description, heading, cooldown)
                             VALUES
                                 (NULL, ?, ?, ?, ?)",
                             [$command, $description, $heading, $cooldown]
    );
    }
}
