<?php

namespace Tests\GcoBundle\Entity;

use GcoBundle\Entity\Technology;

class TechnologyTest extends \PHPUnit_Framework_TestCase
{

    private $technologyEntity;

    public function __construct()
    {
        $this->technologyEntity = new Technology();
    }

    public function testEntity() {

        $coreId = 9;
        $technology = 'java';
        $technologyObj = $this->technologyEntity;
        $technologyObj->setCoreId($coreId);
        $technologyObj->setTechnology($technology);
        $this->assertEquals($coreId, $technologyObj->getCoreId());
        $this->assertEquals($technology, $technologyObj->getTechnology());

    }
}