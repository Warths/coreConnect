<?php



namespace App\Core;

use App\Core\Exceptions\EnvironmentNotFountException;

// ENVIRONMENT SINGLETON 
class Environment {

    function __construct(private $path="/../../.env") {}

    function load() {

        // Getting and spliting config file
        set_error_handler(function() {
            throw new EnvironmentNotFountException(
                'Could not find env file (looking at "'.__DIR__.$this->path.'")'
            );
        });
        $env = file_get_contents(__DIR__.$this->path);
        restore_error_handler();


        $env = explode("\n", $env);

        foreach($env as $line) {
            // Sanityzing lines 
            if (strlen($line) == 0 || str_starts_with($line, "#") || !str_contains($line, "=")) {
                continue;
            }

            /*
             * Adding to env
             * 
             */

            // Sanityzing values
            $tuple = explode("=", $line, 2);
            $key = trim($tuple[0]);
            $value = trim(trim($tuple[1]), ";");
            
            // Adding value to $_ENV superglobal
            $_ENV[$key] = $value;

        }
    }
}

class EnvironmentException {

}