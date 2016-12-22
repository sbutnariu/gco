<?php

namespace Tests\GcoBundle\Factory;

use GcoBundle\Factory\LevelFactory;
use GcoBundle\Entity\Level;

class LevelFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateLevel()
    {
        $newLevel = array(
            'id' => 1,
            'label' => 'UnitTest'
        );
        
        $expectedResponse = new Level();
        $expectedResponse->setId($newLevel['id']);
        $expectedResponse->setName($newLevel['label']);
        
        $actualResponse = (new LevelFactory())->generateLevel($newLevel);
        
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
        $this->assertEquals($expectedResponse->getId(), $actualResponse->getId());
        $this->assertEquals($expectedResponse->getName(), $actualResponse->getName());
    }
}