<?php

namespace GcoBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use GcoBundle\Exception\CoreTechnologyAlreadyExistsException;

class CoreTechnologyService {
    
    private $dataFixture;
    
    public function __construct(CoreTechnologyDataFixture $dataFixture)
    {
         $this->dataFixture = $dataFixture;
    }

    public function getCoreTechnology($name)
    {
        return new Response("service", 200);
    }
    
    public function addCoreTechnology($coreTechnologyName)
    {
        $isDuplicateTechnology = $this->dataFixture->checkDuplicateCoreTechnology($coreTechnologyName);
        
        if ($isDuplicateTechnology){
            throw new CoreTechnologyAlreadyExistsException('Core technology '.$coreTechnologyName.' already exists');
        }
        
        $this->dataFixture->setCoreTechnology($coreTechnologyName);
           
    }

}
