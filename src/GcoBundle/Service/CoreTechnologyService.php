<?php

namespace GcoBundle\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use GcoBundle\DataFixture\CoreTechnologyDataFixture;

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
    
    public function setCoreTechnology($coreTechnologyName)
    {
        $isDuplicateTechnology = $this->dataFixture->checkDuplicateCoreTechnology($coreTechnologyName);
        if (!$isDuplicateTechnology){
            $this->dataFixture->setCoreTechnology($coreTechnologyName);
        }
        else{
            return new Response("duplicate technology", 200);
        }
      
    }

}
