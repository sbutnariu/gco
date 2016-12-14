<?php
namespace Tests\GcoBundle\Factory\TechnologyFactoryTest;
use GcoBundle\Entity\Technology;
use GcoBundle\Factory\TechnologyFactory;

class TechnologyFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $technology = array(
            'coreTechnologyId' => '1',
            'technologyName' => 'C++'
        );
        $expectedResponse = new Technology();
        $expectedResponse->setCoreId($technology['coreTechnologyId']);
        $expectedResponse->setTechnology($technology['technologyName']);

        $actualResponse = TechnologyFactory::create($technology);

        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);

        $this->assertEquals($expectedResponse->getCoreId(), $actualResponse->getCoreId());

        $this->assertEquals($expectedResponse->getTechnology(), $actualResponse->getTechnology());
    }
}