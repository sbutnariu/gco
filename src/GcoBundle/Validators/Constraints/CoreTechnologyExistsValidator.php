<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use GcoBundle\Service\CoreTechnologyService;

class CoreTechnologyExistsValidator extends ConstraintValidator
{
    /**
     * @var CoreTechnologyService
     */
    private $coreTechnologyService;
    /**
     * @param CoreTechnologyService
     */
    public function __construct(CoreTechnologyService $coreTechnology)
    {
        $this->coreTechnologyService = $coreTechnology;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
       /* if(!$constraint instanceof CoreTechnologyExists) {
            throw new UnexpectedTypeException($constraint,__NAMESPACE__ . '\CoreTechnologyExists');
        }*/

        if (empty($value)) {
            throw new UnexpectedTypeException($value, '');
        }

        $exists = $this->coreTechnologyService->getCoreTechnologyByName($value);

        if($exists) {
            $this->context->addViolation($constraint->message);
        }

    }
}


