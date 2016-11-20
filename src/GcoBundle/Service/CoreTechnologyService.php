<?php

namespace GcoBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use GcoBundle\Exceptions\CoreTechnologyAlreadyExistsException;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;


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
    
    public function addCoreTechnology($coreTechnologyName)
    {
       
        $errors = $this->validator->validate($coreTechnologyName, array(new NotBlank()));
        
        if (count($errors) > 0) {
            throw new InvalidParameterException('Invalid parameters :' . $errors->get(0)->getMessage());
        }
        // check if the technology doesn't exist in DB
        $isDuplicateTechnology = $this->dataFixture->checkDuplicateCoreTechnology($coreTechnologyName);
        
        if ($isDuplicateTechnology){
            throw new CoreTechnologyAlreadyExistsException('Core technology '.$coreTechnologyName.' already exists');
        }
        
        // add technology to DB
        $this->dataFixture->setCoreTechnology($coreTechnologyName);
           
    }

}
