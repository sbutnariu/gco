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

    private $validator;

    public function __construct(TechnologyDataFixture $dataFixture, ValidatorInterface $validator)
    {
        $this->dataFixture = $dataFixture;
        $this->validator = $validator;
    }

    /**
     * @param $id
     * @return null|Technology
     */
    public function getTechnology($id)
    {
        return $this->dataFixture->getTechnology($id);
    }


    /**
     * Add new technology
     *
     * @param array $technology
     * @return Technology
     */
    public function addTechnology(array $technology)
    {
        $newTechnology = new Technology();
        $newTechnology->setCoreId($technology['coreTechnologyId']);
        $newTechnology->setTechnology($technology['technologyName']);
        $errors = $this->validator->validate($newTechnology);
        if (count($errors) > 0)
        {
            $errorsString = (string) $errors;
            throw new Exception($errorsString)
        }
        return $this->dataFixture->addTechnology($newTechnology);
    }
}
