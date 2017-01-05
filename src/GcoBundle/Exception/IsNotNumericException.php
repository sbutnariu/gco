<?php

namespace GcoBundle\Exception;

class IsNotNumericException extends \Symfony\Component\HttpKernel\Exception\HttpException
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct(400, 'The User id needs to be numeric');
    }
}

