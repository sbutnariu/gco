<?php

namespace Tests\GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function createRequest()
    {
        $coreTechnologyName = 'php';
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $request= json_encode($request);

        return $request;
    }

    /**
     *
     */
    public function testAddAction()
    {
        $coreTechnologyName= json_encode(array('name'=>'wdwe'));
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($this->any())->method('addCoreTechnology')->willReturn(Response::HTTP_CREATED);

        $containerMock = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')->disableOriginalConstructor()->getMock();

        $dao = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        $dao->expects($this->any())->method('saveCoreTechnology')->willReturn(Response::HTTP_CREATED);

        $controller = $this->getMockBuilder('GcoBundle\Controller\CoreTechnologyController')
            ->setConstructorArgs(array($serviceMock, $containerMock))
            ->setMethods(array('generateUrl'))
            ->getMock();
        $controller->expects($this->any())->method('generateUrl')->willReturn('/technology/core');
        $actualResponse = $controller->addAction($request);
        $this->assertEquals(Response::HTTP_CREATED, $actualResponse->getStatusCode());
    }
}
