<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use GcoBundle\Service\SkillService;

class TechnologyExistsValidator extends ConstraintValidator
{
    /**
     * @var SkillService
     */
    private $skillService;
    /**     
     * @param SkillService
     */
    public function __construct(SkillService $skill)
    {        
        $this->skillService = $skill;
    }
    
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof TechnologyExists) {
            throw new UnexpectedTypeException(
                $constraint,
                __NAMESPACE__ . '\TechnologyExists'
            );
        }
        
         if (empty($value)) {
            return;
        }
        
        if (!is_int($value)) {
            throw new UnexpectedTypeException($value, 'integer');
        }
                
        $exists = $this->skillService->technologyExists($value);
        
        if(!$exists) {
            //throw new ConflictHttpException($constraint->message);
            $this->context->addViolation($constraint->message);
        }
        
    }
}


