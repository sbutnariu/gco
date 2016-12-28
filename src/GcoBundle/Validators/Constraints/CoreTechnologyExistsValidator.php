<?php

namespace GcoBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
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
            throw new InvalidParameterException($value, Response::HTTP_NO_CONTENT);
        }

        $coreTechnology = $this->coreTechnologyService->getCoreTechnologyByName($value);

        if($coreTechnology->getTechnology()) {
            //$this->context->addViolation($constraint->message);
            throw new CoreTechnologyAlreadyExistsException("Already exists", Response::HTTP_NO_CONTENT);
        }

    }
}


