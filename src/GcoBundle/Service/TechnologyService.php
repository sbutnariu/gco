<?php

namespace GcoBundle\Service;
use GcoBundle\Entity\Technology;
use GcoBundle\Factory\TechnologyFactory;
use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Validators\ExistsCoreTechnology;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use GcoBundle\Exceptions\NotFoundException;
use GcoBundle\Exceptions\WrongTypeException;

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

    /**
     * TechnologyService constructor.
     * @param TechnologyDataFixture $dataFixture
     * @param ValidatorInterface $validator
     */
    public function __construct(TechnologyDataFixture $dataFixture, ValidatorInterface $validator)
    {
        $this->dataFixture = $dataFixture;
        $this->validator = $validator;
    }

    /**
     * @param integer $id
     * @return null|Technology
     * @throws NotFoundException|WrongTypeException
     */
    public function getTechnology($id)
    {
        $technology = $this->dataFixture->getTechnology($id);
        /*$errors = $this->validator->validate($technology);
        if (count($errors) > 0)
        {
            var_dump($errors);
            throw new WrongTypeException();
        }*/
        return $technology;
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
        $newTechnology = TechnologyFactory::create($technology);
        $errors = $this->validator->validate($newTechnology, new ExistsCoreTechnology());
        if (count($errors) > 0)
        {
            var_dump($errors);
            throw new WrongTypeException();
        }
        return $this->dataFixture->addTechnology($newTechnology)->getId();
    }
}
