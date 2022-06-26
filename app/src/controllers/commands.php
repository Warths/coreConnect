<?php

use App\Core\Controller;
use App\Core\Response\JsonResponse;
use App\Src\Models\CommandRepository;

class CommandController extends Controller {
    function get_command($params) {
        $repo = new CommandRepository();
        $command = $repo->byId($params["id"]);
        if ($command)
            return new JsonResponse($command);
        else 
            return new JsonResponse(["error"=>"Not found"], 404);
    }

    function get_all_commands() {
        $repo = new CommandRepository();
        $commands = $repo->all();
        return new JsonResponse($commands);
    }

    function create_command($params) {
        $command = $_POST["command"];
        $description = $_POST["description"];
        $heading = $_POST["heading"];
        $cooldown = $_POST["cooldown"];
        $repo = new CommandRepository();
        $repo->add_command($command, $description, $heading, $cooldown);
    }
}
CommandController::describe("/command/all/", "get_all_commands", ["GET"]);
CommandController::describe("/command/create/", "create_command", ["POST"]);
CommandController::describe("/command/{id}/", "get_command", ["GET"]);
