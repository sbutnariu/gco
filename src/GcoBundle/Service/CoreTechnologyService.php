<?php

namespace GcoBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use GcoBundle\Exceptions\CoreTechnologyAlreadyExistsException;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use GcoBundle\Exceptions\InvalidParameterException;
use GcoBundle\Entity\CoreTechnology;


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
     * @param  coreTechnologyName
     */

    public function addCoreTechnology(CoreTechnology $coreTechnology)
    {
        $this->validator->validate($coreTechnology);
        $this->dataFixture->saveCoreTechnology($coreTechnology);
    }

    public function getCoreTechnologyByName($coreTechnologyName)
    {
        $coreTechnology = $this->dataFixture->getCoreTechnologyByName($coreTechnologyName);
        return $coreTechnology;
    }

}
