<?php

namespace GcoBundle\Validators;
use GcoBundle\Entity\Technology;
use GcoBundle\Service\TechnologyService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Checks if the coreTechnologyId exists
 */
class NoDuplicateTechnologyValidator extends ConstraintValidator
{
    /** @var $coreTechnologyService */
    private $technologyService;

    public function __construct(TechnologyService $technologyService)
    {
        $this->technologyService = $technologyService;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($technology, Constraint $constraint)
    {

        $technologyProperties = array(
            'coreTechnologyId' => $technology->getCoreId(),
            'technologyName' => $technology->getTechnology()
        );
        $technologyExists = $this->technologyService->getTechnologyId($technologyProperties);

        if (!is_null($technologyExists)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
