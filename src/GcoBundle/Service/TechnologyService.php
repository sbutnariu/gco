<?php

namespace GcoBundle\Service;
use GcoBundle\Entity\Technology;
use GcoBundle\Factory\TechnologyFactory;
use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Validators\ExistsCoreTechnology;
use GcoBundle\Validators\NoDuplicateTechnology;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use GcoBundle\Exceptions\NotFoundException;
use GcoBundle\Exceptions\WrongTypeException;
use GcoBundle\Exceptions\ExistsAlreadyException;

/**
 * Class TechnologyService
 * @package GcoBundle\Service
 */
class TechnologyService
{
    /**
     * @var TechnologyDataFixture
     */
    private $dataFixture;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /*
     * @var array
     */
    private $exceptions;
    /**
     * TechnologyService constructor.
     * @param TechnologyDataFixture $dataFixture
     * @param ValidatorInterface $validator
     */
    public function __construct(TechnologyDataFixture $dataFixture, ValidatorInterface $validator)
    {
        $this->dataFixture = $dataFixture;
        $this->validator = $validator;
        $this->exceptions = array(
            'GcoBundle\Validators\NoDuplicateTechnology' => 'GcoBundle\Exceptions\ExistsAlreadyException',
            'GcoBundle\Validators\ExistsCoreTechnology' => 'GcoBundle\Exceptions\NotFoundException'
        );
    }

    /**
     * Get technology by $id
     *
     * @param integer $id
     * @return null|Technology
     * @throws NotFoundException|WrongTypeException
     */
    public function getTechnology($id)
    {
        $technology = $this->dataFixture->getTechnology($id);
        if(empty($technology))
            throw new NotFoundException();
        return $technology;
    }

    /**
     * Get $technology id
     *
     * @param array $technology
     * @return null|Technology
     * @throws NotFoundException|WrongTypeException
     */
    public function getTechnologyId(array $technology)
    {
        $newTechnology = TechnologyFactory::create($technology);
        $technologyId = $this->dataFixture->getTechnologyId($newTechnology);
        return $technologyId;
    }

    /**
     * Add new technology
     *
     * @param array $technology
     * @return int
     * @throws WrongTypeException
     */
    public function addTechnology(array $technology)
    {
        //create object on controller
        $newTechnology = TechnologyFactory::create($technology);
        $validators = array(
            new ExistsCoreTechnology(),
            new NoDuplicateTechnology()
        );
        $errors = $this->validator->validate($newTechnology, $validators);
        foreach ($errors as $error)
        {
                    $constraint = get_class($error->getConstraint());
                    $exception = $this->exceptions[$constraint];
                    var_dump($exception);
                    throw new $exception();
        }
        return $this->dataFixture->addTechnology($newTechnology)->getId();
    }
}
