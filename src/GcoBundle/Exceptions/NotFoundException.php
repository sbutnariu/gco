<?php

namespace GcoBundle\Exceptions;


class NotFoundException extends GcoException {

    const INVALID_ROUTE_NAME= 'INVALID_ROUTE_NAME';
    const MESSAGE = 'Route not found';
}