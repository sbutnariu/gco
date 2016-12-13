<?php
namespace GcoBundle\Exceptions;
class ExistsAlreadyException extends \Exception
{
    const ERROR_MESSAGE = "The resource exists already";
    public function __construct()
    {
        parent::__construct($this::ERROR_MESSAGE);
    }
}