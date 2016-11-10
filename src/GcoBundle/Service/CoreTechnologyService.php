<?php

namespace GcoBundle\Service;
use GcoBundle\Entity\CoreTechnology;
use GcoBundle\Entity\Technology;
use GcoBundle\DataFixture\TechnologyDataFixture;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TechnologyService
 * @package GcoBundle\Service
 */
class CoreTechnologyService
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
     * @return null|CoreTechnology
     */
    public function getTechnology($id)
    {
        $technology = new CoreTechnology();
        return $technology;
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
            throw new Exception($errorsString);
        }
        return $this->dataFixture->addTechnology($newTechnology);
    }
}
