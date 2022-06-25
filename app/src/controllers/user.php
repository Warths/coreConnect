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
    
    function authenticate() {
        $repo = new UserRepository();
        $user = $repo->getUserByLogin($_POST["login"]);
        $authenticated = md5($user["registered_date"].$_POST["pass"]) == $user["pass"];
        if ($authenticated) {
            $token = JWT::encode(["username"=>$user["name"]]);
            return new JsonResponse(["token"=>$token]);
        } 
        return new JsonResponse(["error"=>"Unauthorized"], 401);
        
    }

    function validate() {
        $authorization = getallheaders()["Authorization"];
        $token = new JWT($authorization);
        if ($token->validate()) {
            return new JsonResponse($token->get_payload());
        }
        return new JsonResponse(["error"=>"Unauthorized"], 401);
    }
}

UserController::describe("/user/create/", "create_user", ["POST"]);
UserController::describe("/user/authenticate/", "authenticate", ["POST"]);
UserController::describe("/user/validate/", "validate", ["POST"]);

