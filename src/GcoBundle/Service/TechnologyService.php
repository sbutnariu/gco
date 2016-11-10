<?php

namespace GcoBundle\Service;
use GcoBundle\Entity\Technology;
use GcoBundle\DataFixture\TechnologyDataFixture;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @param $id
     * @return null|Technology
     * @throws \NotFoundException|\WrongTypeException
     */
    public function getTechnology($id)
    {
        if(!is_int($id))
            throw new \WrongTypeException();
        $technology = $this->dataFixture->getTechnology($id);
        if(is_null($technology))
            throw new \NotFoundException();
        return $technology;
    }


    /**
     * Add new technology
     *
     * @param array $technology
     * @return Technology
     * @throws \WrongTypeException
     */
    public function addTechnology(array $technology)
    {
        if(
            !is_array($technology)||
            !isset($technology['coreTechnologyId'])||
            !isset($technology['technologyName'])||
            !is_int($technology['coreTechnologyId'])
        )
            throw new \WrongTypeException();
        $newTechnology = new Technology();
        $newTechnology->setCoreId($technology['coreTechnologyId']);
        $newTechnology->setTechnology($technology['technologyName']);
        $errors = $this->validator->validate($newTechnology);
        if (count($errors) > 0)
        {
            throw new \WrongTypeException();
        }
        return $this->dataFixture->addTechnology($newTechnology);
    }
}
