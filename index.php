<?php

require __DIR__ . "/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");

use App\Core\CoreConnect;
(new CoreConnect())->serve();