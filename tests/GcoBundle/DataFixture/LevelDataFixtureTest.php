<?php

namespace Tests\GcoBundle\DataFixture;

use GcoBundle\DataFixture\LevelDataFixture;
use GcoBundle\Entity\Level;

class LevelDataFixtureTest extends \PHPUnit_Framework_TestCase
{
    public function testAddLevel()
    {
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\Level')
                ->disableOriginalConstructor()
                ->getMock();
        
        $repoMock = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();
        
        $repoMock->expects($this->once())
                ->method('find')
                ->will($this->returnValue($entityMock));
        
        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock();
        
        $emMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($repoMock));
        
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
                ->disableOriginalConstructor()
                ->getMock();
               
        $doctrineMock->expects($this->once())
                ->method('getManager')
                ->will($this->returnValue($emMock));
        
        $dataFixture = new LevelDataFixture($doctrineMock);
        
        $expectedResponse = new Level();
        
        $actualResponse = $dataFixture->addLevel($entityMock);
        
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
}