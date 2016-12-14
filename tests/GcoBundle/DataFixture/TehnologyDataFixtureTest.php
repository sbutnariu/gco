<?php

namespace Tests\GcoBundle\DataFixture;

use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Entity\Technology;

class TechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTechnology()
    {
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->getMock();
        $repoMock = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repoMock->expects($this->any())
            ->method('find')
            ->will($this->returnValue(new Technology()));
        $doctrineMock->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($repoMock));
        $dataFixture = new TechnologyDataFixture($doctrineMock);

        $expectedResponse = new Technology();
        $actualResponse = $dataFixture->getTechnology(1);
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
    public function testGetTechnologyId()
    {

        $technologyMock = $this->getMockBuilder('GcoBundle\Entity\Technology')
            ->disableOriginalConstructor()
            ->getMock();
        $technologyMock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));
        $repoMock = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repoMock->expects($this->any())
            ->method('findBy')
            ->will($this->returnValue(array($technologyMock)));
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->getMock();
        $doctrineMock->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($repoMock));
        $dataFixture = new TechnologyDataFixture($doctrineMock);

        $expectedResponse = $technologyMock->getId();
        $actualResponse = $dataFixture->getTechnologyId($technologyMock);
        $this->assertEquals($expectedResponse, $actualResponse);
    }
    public function testAddTechnology()
    {

        $managerMock = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();

        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->getMock();
        $doctrineMock->expects($this->any())
            ->method('getManager')
            ->will($this->returnValue($managerMock));

        $dataFixture = new TechnologyDataFixture($doctrineMock);

        $expectedResponse = new Technology();
        $actualResponse = $dataFixture->addTechnology(new Technology());
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
}
