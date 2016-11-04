<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Request;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCoreTechnologyAction()
    {
        $coreTechnologyName = 'php';
        
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();
        
        $fixtureMock->expects($coreTechnologyName)
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));
        
        
        
        $serviceMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyService')
            ->disableOriginalConstructor()
            ->getMock();
        
        $serviceMock->expects($coreTechnologyName)
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));
        
        
        
        $ctrl = new CoreTechnologyController($fixtureMock);

        $request = new Request($coreTechnologyName, json_encode(array()));

        $actualResponse = $ctrl->getCoreTechnologyAction($request, 1);
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
}
