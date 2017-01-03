<?php
namespace GcoBundle\Exceptions;

use GcoBundle\Exceptions\GcoException;


class CoreTechnologyAlreadyExistsException extends GcoException
{
    /**
     * Constructor
     * @param string $errorCode the specific error code
     * @param string $message the message to be shown
     */
    public function __construct($message, $errorCode)
    {
        parent::__construct($message, $errorCode);
    }

    public function getStatusCode()
    {
        return $this->getErrorCode();
    }


}
