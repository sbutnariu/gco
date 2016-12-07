<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function createRequest(){
        $coreTechnologyName = 'php';
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $request= json_encode($request);

        return $request;
    }
    public function testAddAction()
    {
        $coreTechnologyName = "{name:'php'}";
        $coreTechnologyName= json_encode($coreTechnologyName);
        $request = new Request(array(), $coreTechnologyName, array(), array(), array(), array(), null);

        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);

        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($coreTechnologyEntity)
            ->method('addCoreTechnology')
            ->shouldBeCalledTimes(1)->willReturn(201);

        //$fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();

        $ctrl = new CoreTechnologyController($serviceMock);
        $actualResponse = $ctrl->addAction($request);
        $this->assertEquals(204, $actualResponse->getStatusCode());
    }

}
