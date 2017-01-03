<?php

namespace GcoBundle\Service;

use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use Symfony\Component\Validator\Validator\ValidatorInterface;
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

}
