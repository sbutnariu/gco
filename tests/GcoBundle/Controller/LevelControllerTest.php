<?php

namespace Tests\GcoBundle\Entity;

use GcoBundle\Controller\LevelController;
use Symfony\Component\HttpFoundation\Request;


class LevelControllerTest extends \PHPUnit_Framework_TestCase
{
    
    public function testaddLevelAction()
    {
        
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\Level')
                ->getMock();
             
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\LevelService')
                ->disableOriginalConstructor()
                ->getMock();
        
        $factoryMock = $this->getMockBuilder('GcoBundle\Factory\LevelFactory')
                ->getMock();
        $factoryMock->expects($this->once())
                ->method('generateLevel')
                ->willReturn($entityMock);
        
        $serviceMock->expects($this->once())
                ->method('addLevel')
                ->with($entityMock);
        
        $ctrl = new LevelController($serviceMock,$factoryMock);
        
        $request = new Request(array(), array(), array(), array(), array(), array(), json_encode(array()));
        
        $testResponse = $ctrl->addLevelAction($request);
        
        $this->assertEquals(204,$testResponse->getStatusCode());
    }
            
}

