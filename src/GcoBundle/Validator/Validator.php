<?php

namespace GcoBundle\Validator;

class Validator
{
    const INCIDENT_ERROR =500;
    const NOT_FOUND = 404;
    const STATUS_OK = 200;

    public function __construct()
    {

    }

    /**
     * @param $technology
     * @param $results
     * @return array|int response for this incident
     */
    public static function validateTechnology($technology, $results = '')
    {
        if($results == array()) {
            return array(
                'code' => self::NOT_FOUND,
                'error' => " No results for " . $technology
            );
        }
        if(is_null($technology)) {
            return array(
                'code' => self::INCIDENT_ERROR,
                'error' => " An error appears for " . $technology
            );
        }

        return self::STATUS_OK;
    }
}