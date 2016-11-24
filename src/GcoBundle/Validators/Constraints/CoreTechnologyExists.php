<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Check if the technology exists in the DB
 */
class TechnologyExists extends Constraint
{
    public $message = 'Technology does not exist';
    
    public function validatedBy()
    {
        return get_class($this).'Validator';    
    }
    
}
