<?php
namespace GcoBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CoreTechnologyAlreadyExistsException extends \RuntimeException {
//https://knpuniversity.com/screencast/symfony-rest2/api-exception-subscriber
    protected $code = Response::HTTP_BAD_REQUEST;
    
    public function __construct($message){
        parent::__construct($message);
    }
    
}
