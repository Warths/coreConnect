<?php

use App\Core\Controller;

class GetUserController extends Controller {
    function user() {
        echo "<h1>User Controller</h1>";
    }
}

GetUserController::describe("/{user}/", "user");
