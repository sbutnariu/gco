<?php

namespace GcoBundle\Exceptions;


class InvalidParametersException extends GcoException
{
    const WRONG_DATA_TYPE = 'WRONG_DATA_TYPE';
    const MESSAGE = 'Wrong data type, it needs to be int';
}