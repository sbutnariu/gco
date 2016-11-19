<?php

namespace GcoBundle\Exceptions;

abstract class GcoException extends \Exception
{
        private $errorCode;
    
    /**
     * Constructor
     * @param string $errorCode the specific error code
     * @param string $message the message to be shown
     */
    public function __construct($errorCode, $message)
    {
        parent::__construct($message, $code);
        
        $this->errorCode = $errorCode;
    }
    
    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
