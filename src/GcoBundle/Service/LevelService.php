<?php

namespace GcoBundle\Service;

use GcoBundle\Entity\Level;
use GcoBundle\DataFixture\LevelDataFixture;

class LevelService
{
    /**
     * @var LevelDataFixture
     */
    protected $dataFixture;

    /**
     * LevelService constructor
     * @param LevelDataFixture $dataFixture
     */
    public function __construct(LevelDataFixture $dataFixture)
    {
        $this->dataFixture = $dataFixture;
    }
    
    /**
     * Give a Level object to the addLevel method in the DataFixture file
     * @param Level $levelObject
     * @return Level
     */
    public function addLevel(Level $levelObject)
    {
        return $this->dataFixture->addLevel($levelObject);
    }
}
