<?php

namespace Tests\GcoBundle\Service;

use GcoBundle\Service\TechnologyService;
use GcoBundle\Factory\TechnologyFactory;

class TechnologyServiceTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var TechnologyService
     */
    private $service;
    private $dataFixture;

    public function setUp() {

        $this->dataFixture = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new TechnologyService($this->dataFixture);
    }

    public function providerGetTechnology()
    {
        return array(
            array(
                array(
                    'id' => 1,
                    'core_id' => 2,
                    'technology' => 'javascript'
                )
            )
        );
    }

    /**
     * @dataProvider providerGetTechnology
     */
    public function testGetListOfTechnologies($technologyArray) {

        $actualResult = TechnologyFactory::create($technologyArray);
        $this->dataFixture->expects($this->any())
            ->method('getListOfTechnologies')
            ->will($this->returnValue(array($actualResult)));

        $expectedResult = $this->service->getListOfTechnologies($technologyArray['technology']);
        $this->assertEquals(array($actualResult), $expectedResult);

    }
}