<?php

namespace GcoBundle\Service;

use GcoBundle\Entity\Level;
use GcoBundle\DataFixture\LevelDataFixture;


class LevelService
{
    
    protected $dataFixture;

    public function __construct(LevelDataFixture $dataFixture)
    {
        $this->dataFixture = $dataFixture;
    }
    
    
    public function addLevel(Level $levelObject)
    {
        return $this->dataFixture->addLevel($levelObject);
    }
    

}
