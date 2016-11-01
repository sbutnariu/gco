<?php

namespace GcoBundle\Service;

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
        $this->dataFixture->setCoreTechnology($coreTechnologyName);
    }
}
