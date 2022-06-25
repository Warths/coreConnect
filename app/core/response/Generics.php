<?php 

namespace App\Core\Response;



class Generics {
    public const json500 = [["error"=>"Internal server error"], 500];
    public const json404 = [["error"=>"Not found"], 404];
    public const json403 = [["error"=>"Unauthorized"], 403];
    public const http500 = ["<h1>Internal server error</h1>", 500];
    public const http404 = ["<h1>Not Found</h1>", 404];
    public const http403 = ["<h1>Unauthorized</h1>", 403];
}
