<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use GcoBundle\Exceptions\CoreTechnologyAlreadyExistsException;
use GcoBundle\Service\CoreTechnologyService;
use GcoBundle\Exceptions\InvalidParameterException;
use Symfony\Component\HttpFoundation\Response;

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
        if (empty($value)) {
            throw new InvalidParameterException("Empty value", Response::HTTP_BAD_REQUEST);
        }

        $coreTechnology = $this->coreTechnologyService->getCoreTechnologyByName($value);

        if($coreTechnology) {
            throw new CoreTechnologyAlreadyExistsException("Already exists", Response::HTTP_BAD_REQUEST);
        }

    }
}


