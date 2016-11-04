<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\TechnologyController;
use Symfony\Component\HttpFoundation\Request;

class TechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserAction()
    {
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock = $this->getMockBuilder('Symfony\Component\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock->expects($this->any())
            ->method('serialize')
            ->will($this->returnValue(json_encode(array())));
        $ctrl = new TechnologyController($fixtureMock, $serializerMock);

        $request = new Request(array(), array(), array(), array(), array(), array(), json_encode(array()));

        $actualResponse = $ctrl->getTechnologyAction($request, 1);
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
}
