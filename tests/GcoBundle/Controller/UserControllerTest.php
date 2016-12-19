<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserAction()
    {
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\UserDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock = $this->getMockBuilder('Symfony\Component\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $serializerMock->expects($this->any())
            ->method('serialize')
            ->will($this->returnValue(json_encode(array())));
        $ctrl = new UserController($fixtureMock, $serializerMock);

        $request = new Request(array(), array(), array(), array(), array(), array(), json_encode(array()));

        $actualResponse = $ctrl->getUserAction($request, 1);
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
    
}
