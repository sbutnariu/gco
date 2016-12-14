<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Check if the core technology exists in the DB
 */
class CoreTechnologyExists extends Constraint
{
    public $message = 'This technology is already in database';
    
    public function validatedBy()
    {
        return get_class($this).'Validator';    
    }
    
}
