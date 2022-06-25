<?php
namespace App\Src\Models;

use App\Core\Model; 

class UserRepository extends Model {
    protected $table = "users";

    function getUserById($id) {
        return $this->fetch("SELECT id, name, email from $this->table WHERE id = ?", [$id]);
    }

    function getUserByLogin($login) {
        return $this->fetch("SELECT * from $this->table WHERE name = ? OR email = ?;", [$login, $login]);
    }


    function createUser($name, $email, $password) {
        $timestamp = time();
        $salted_pass = $timestamp.$password;



        return $this->query(
            "INSERT into $this->table 
                (id, name, pass, email, registered_date, permissions_level, banned, activation_key)
            VALUES
                (NULL, ?, MD5(?), ?, ?, 0, 0, MD5(RAND()));",
            [$name, $salted_pass, $email, $timestamp]
        );
    }
}