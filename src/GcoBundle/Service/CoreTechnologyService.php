<?php

namespace GcoBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use GcoBundle\Exception\CoreTechnologyAlreadyExistsException;

class CoreTechnologyService {
    /**
     * @var DataFixture
     */
    private $dataFixture;
    
     /**
     *
     * @param DataFixture   $dataFixture
     */
    public function __construct(CoreTechnologyDataFixture $dataFixture)
    {
         $this->dataFixture = $dataFixture;
    }

    public function getCoreTechnology($name)
    {
       // to be implemented
    }
    
    /**
     *
     * @param  coreTechnologyName
     */
    
    public function addCoreTechnology($coreTechnologyName)
    {
        // check if the technology doesn't exist in DB
        $isDuplicateTechnology = $this->dataFixture->checkDuplicateCoreTechnology($coreTechnologyName);
        
        if ($isDuplicateTechnology){
            throw new CoreTechnologyAlreadyExistsException('Core technology '.$coreTechnologyName.' already exists');
        }
        
        // add technology to DB
        $this->dataFixture->setCoreTechnology($coreTechnologyName);
           
    }

}
