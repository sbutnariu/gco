<?php

namespace GcoBundle\Exceptions;

abstract class GcoException extends \Exception
{
        private $errorCode;
    
    /**
     * Constructor
     * @param string $message the message to be shown
     * @param string $errorCode the specific error code
     */
    public function __construct($message, $errorCode)
    {
        parent::__construct($message, $errorCode);
        
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
