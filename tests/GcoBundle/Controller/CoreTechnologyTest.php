<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Request;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCoreTechnologyAction()
    {
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock = $this->getMockBuilder('Symfony\Component\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock->expects($this->any())
            ->method('serialize')
            ->will($this->returnValue(json_encode(array())));
        $ctrl = new CoreTechnologyController($fixtureMock, $serializerMock);

        $request = new Request(array(), array(), array(), array(), array(), array(), json_encode(array()));

        $actualResponse = $ctrl->getCoreTechnologyAction($request, 1);
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
}
