<?php

use App\Core\Auth\JWT;
use App\Core\Controller;
use App\Core\Response\JsonResponse;
use App\Src\Models\UserRepository;

class UserController extends Controller {
    function create_user() {
        $repo = new UserRepository();
        // TODO VALIDATION
        $repo->createUser($_POST["name"], $_POST["email"], $_POST["password"]);
        return new JsonResponse($_POST);
    }

    function check_pass($user, $pass) {
        return md5($user["registered_date"].$pass) == $user["pass"];
    }

    function authenticate() {
        $repo = new UserRepository();
        $user = $repo->getUserByLogin($_POST["login"]);
        $authenticated = $this->check_pass($user, $_POST["pass"]);
        
    }


    function testjwt() {
        JWT::encodeJWT(["payload"]);
    }
    
}

UserController::describe("/user/create/", "create_user", ["POST"]);
UserController::describe("/user/authenticate/", "testjwt", ["POST"]);
