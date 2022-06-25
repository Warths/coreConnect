<?php

use App\Core\Controller;
use App\Core\Response\JsonResponse;
use App\Src\Models\CommandRepository;

class CommandController extends Controller {
    function getCommand($params) {
        $repo = new CommandRepository();
        $command = $repo->byId($params["id"]);
        if ($command)
            return new JsonResponse($command);
        else 
            return new JsonResponse(["error"=>"Not found"], 404);
    }

    function getAllCommands() {
        $repo = new CommandRepository();
        $commands = $repo->all();
    }
}

CommandController::describe("/command/{id}/", "getCommand", ["GET"]);

