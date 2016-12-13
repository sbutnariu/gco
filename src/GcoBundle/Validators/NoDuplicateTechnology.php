<?php

namespace GcoBundle\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * Checks if the coreTechnologyId exists
 */
class NoDuplicateTechnology extends Constraint
{
    public $message = 'Technology already exists.';

    public function validatedBy()
    {
        /*return 'gco_core_technology_exists';*/
        return get_class($this).'Validator';
    }
}
