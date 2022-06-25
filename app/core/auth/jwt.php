<?php

namespace App\Core\Auth;


class JWT {
    static private $secret = "eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFt";

    function __construct($token) {
        $this->token = $token;
    }

    static function encodeJWT($payload, $header = ["alg"=> "HS256", "typ"=> "JWT"]) {
        $header = base64_encode(json_encode($header));
        $payload = base64_encode(json_encode($payload));

        $header = str_replace(["+", "/", "="], ["-", "_", ""], $header);
        $payload = str_replace(["+", "/", "="], ["-", "_", ""], $payload);

        $signature = hash_hmac('sha256', $header . '.' . $payload, JWT::$secret, true);
        $signature = base64_encode($signature);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $signature);

        return var_dump($header . "." . $payload . "." . $signature);
    }

    function validate() {
        $body = $this->get_payload();
        $header = $this->get_header();
        return $this->encodeJWT($body, $header) == $this->token;
    }

    function get_header() {
        $token = explode(".", $this->token);
        return json_decode(base64_decode($token[0]), true);
    }

    function get_payload() {
        $token = explode(".", $this->token);
        return json_decode(base64_decode($token[1]), true);
    }
 
}