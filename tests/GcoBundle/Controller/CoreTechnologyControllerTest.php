<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Request;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function createRequest(){
        $coreTechnologyName = 'php';
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);
        $request= json_encode($request);
        
        return $request;
    }
    public function testAddActionOK()
    {
        $request = $this->createRequest();
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology();
        
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($coreTechnologyEntity)
            ->method('addCoreTechnology')
            ->will(be_call(1));// to do => call once will return $coreTechnologyEntity but with id setted to 7;
        
        $fixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        
        /* $fixtureMock->expects($this->any())
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));
       
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()
            ->setMethods(array('checkDuplicateCoreTechnology'))
            ->getMock();
        
        
         
        $serviceMock->expects($this->any())
            ->method('checkDuplicateCoreTechnology')
            ->will($this->returnValue(TRUE));*/
        
        $ctrl = new CoreTechnologyController($serviceMock);

        

        $actualResponse = $ctrl->addAction($request);
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
    

}
