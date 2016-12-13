<?php

namespace GcoBundle\Validators;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Checks if the coreTechnologyId exists
 */
class ExistsCoreTechnologyValidator extends ConstraintValidator
{
    /** @var $coreTechnologyService */
    private $coreTechnologyService;

    public function __construct(CoreTechnologyService $coreTechnologyService)
    {
        $this->coreTechnologyService = $coreTechnologyService;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $coreId = $value->getId();
        $coreTechnology = $this->coreTechnologyService->getTechnology($coreId);

        if (is_null($coreTechnology)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
