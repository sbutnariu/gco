<?php

namespace GcoBundle\Service;

use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use GcoBundle\Entity\CoreTechnology;
use GcoBundle\Exceptions\InvalidParameterException;
use Symfony\Component\HttpFoundation\Response;


class CoreTechnologyService {
    /**
     * @var DataFixture
     */
    private $dataFixture;

    /**
     *
     * @var ValidatorInterface
     */
    private $validator;

     /**
     *
     * @param DataFixture   $dataFixture
     * @param ValidatorInterface $validator
     */
    public function __construct(CoreTechnologyDataFixture $dataFixture, ValidatorInterface $validator)
    {
         $this->dataFixture = $dataFixture;
         $this->validator = $validator;
    }

    /**
     *
     * @param  $coreTechnology
     */

    public function addCoreTechnology(CoreTechnology $coreTechnology)
    {
        $this->validator->validate($coreTechnology);
        $this->dataFixture->saveCoreTechnology($coreTechnology);
    }

    /**
     *
     * @param  coreTechnologyName
     * @return CoreTechnology
     */
    public function getCoreTechnologyByName($coreTechnologyName)
    {
        $coreTechnology = $this->dataFixture->getCoreTechnologyByName($coreTechnologyName);
        return $coreTechnology;
    }

    /**
     * @param integer $id
     * @return null|CoreTechnology
     * @throws NotFoundException|WrongTypeException
     */
    public function getCoreTechnologyById($id)
    {
        $coreTechnology = $this->dataFixture->getCoreTechnologyById($id);

        if($coreTechnology == null){
            throw new InvalidParameterException("Core technology with id ". $id. " not found", Response::HTTP_BAD_REQUEST);
        }
        return $coreTechnology;

    }
}
