<?php

class CoreTechnologyAlreadyExistsException extends \RuntimeException {
//https://knpuniversity.com/screencast/symfony-rest2/api-exception-subscriber
    private $code = Response::BAD_REQUEST;
    
    public function __construct($message){
        parent::__construct($message);
    }
    
}
