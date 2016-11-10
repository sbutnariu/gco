<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Request;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCoreTechnologyAction()
    {
        $coreTechnologyName = 'php';
        
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        
        $fixtureMock->expects($this->any())
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));
        
        
        
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')
            ->disableOriginalConstructor()
            ->setMethods(array('checkDuplicateCoreTechnology'))
            ->getMock();
        
        $serviceMock->expects($this->any())
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));
        
        $ctrl = new CoreTechnologyController($serviceMock);

        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $actualResponse = $ctrl->addCoreTechnologyAction($request);
        $this->assertEquals(400, $actualResponse->getStatusCode());
    }
}
