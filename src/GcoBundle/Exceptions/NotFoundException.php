<?php
class NotFoundException extends \Exception
{
    const ERROR_MESSAGE = "The resource requested was not found";
    public function __construct()
    {
        parent::__construct($this::ERROR_MESSAGE);
    }
}