<?php 

namespace App\Core\Response;

class HttpResponse {
    private $response;
    private $status_code;
    function __construct($response, $status_code=200) {
        $this->response = $response;
        $this->status_code = $status_code;
    }

    function render() {
        http_response_code($this->status_code);
        echo $this->response;
    }
}