<?php

namespace GcoBundle\Exceptions;


class NotFoundException extends GcoException {

    const NO_DATA_FOUND= 'NO_DATA_FOUND';
    const MESSAGE = 'No data found for this user';
}