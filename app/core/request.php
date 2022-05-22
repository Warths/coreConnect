<?php

namespace App\Core;

class Request {
    public function serveTime() {
        return intval(microtime(true)*1000-$_SERVER["REQUEST_TIME_FLOAT"]*1000);
    }
}