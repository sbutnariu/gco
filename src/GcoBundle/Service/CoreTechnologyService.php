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
        $errors = $this->validator->validate($coreTechnology);

        if (count($errors) > 0) {
            throw new InvalidParameterException('Invalid parameters :' . $errors->get(0)->getMessage());// cod din exceptie sub forma de constanta (al 2-lea param pt throw)
        }
        // add technology to DB
        $this->dataFixture->saveCoreTechnology($coreTechnology);

        return $coreTechnology;
    }

    public function getTechnologyByName($coreTechnologyName){
        return $this->dataFixture->getTechnologyByName($coreTechnologyName);
    }

}
