<?php
namespace GcoBundle\Exceptions;
class WrongTypeException extends \Exception
{
    const ERROR_MESSAGE = "Unexpected type";
    public function __construct()
    {
        parent::__construct($this::ERROR_MESSAGE);
    }
}