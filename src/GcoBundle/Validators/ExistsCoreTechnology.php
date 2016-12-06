<?php

namespace GcoBundle\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * Checks if the coreTechnologyId exists
 */
class ExistsCoreTechnology extends Constraint
{
    public $message = 'Core technology does not exists.';

    public function validatedBy()
    {
        /*return 'gco_core_technology_exists';*/
        return get_class($this).'Validator';
    }
}
