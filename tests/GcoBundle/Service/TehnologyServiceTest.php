<?php

namespace Tests\GcoBundle\Service;

use GcoBundle\Entity\Technology;
use GcoBundle\Service\TechnologyService;

class TechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTechnology()
    {
        $dataFixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $dataFixtureMock->expects($this->any())
            ->method('getTechnology')
            ->will($this->returnValue(new Technology()));
        $validatorMock = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $validatorMock->expects($this->any())
            ->method('validate')
            ->will($this->returnValue(array()));
        $service = new TechnologyService($dataFixtureMock, $validatorMock);

        $expectedResponse = new Technology();
        $actualResponse = $service->getTechnology(1);
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }

    public function testGetTechnologyId()
    {
        $dataFixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $dataFixtureMock->expects($this->any())
            ->method('getTechnologyId')
            ->will($this->returnValue(new Technology()));
        $validatorMock = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $validatorMock->expects($this->any())
            ->method('validate')
            ->will($this->returnValue(array()));
        $service = new TechnologyService($dataFixtureMock, $validatorMock);

        $expectedResponse = new Technology();
        $actualResponse = $service->getTechnologyId(new Technology());
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }

    public function testAddTechnology()
    {
        $dataFixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $dataFixtureMock->expects($this->any())
            ->method('addTechnology')
            ->will($this->returnValue(new Technology()));
        $validatorMock = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $validatorMock->expects($this->any())
            ->method('validate')
            ->will($this->returnValue(array()));
        $service = new TechnologyService($dataFixtureMock, $validatorMock);

        $expectedResponse = new Technology();
        $actualResponse = $service->addTechnology(new Technology());
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
}
