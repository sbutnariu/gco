<?php

namespace Tests\GcoBundle\DataFixture;

use GcoBundle\DataFixture\LevelDataFixture;

class LevelDataFixtureTest extends \PHPUnit_Framework_TestCase
{
    
    public function testAddLevel()
    {
        
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
                ->disableOriginalConstructor()
                ->getMock();
        
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\Level')
                ->getMock();
        
        $dataFixture = new LevelDataFixture($doctrineMock);
        
        $testResponse = $dataFixture->addLevel($entityMock);
        
    }
    
}

