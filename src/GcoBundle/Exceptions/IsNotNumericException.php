<?php

namespace GcoBundle\Exceptions;

class IsNotNumericException extends GcoException
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct(400, 'The User id needs to be numeric');
    }
}

