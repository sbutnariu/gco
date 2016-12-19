<?php

namespace Tests\GcoBundle\Service;

use GcoBundle\Service\LevelService;

class LevelServiceTest extends \PHPUnit_Framework_TestCase
{
    
    public function testAddLevel()
    {
        
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\Level')
                ->getMock();
        
        $dataFxMock = $this->getMockBuilder('GcoBundle\DataFixture\LevelDataFixture')
                ->disableOriginalConstructor()
                ->getMock();
        
        $dataFxMock->expects($this->once())
                ->method('addLevel')
                ->with($entityMock);
        
        $service = new LevelService($dataFxMock);
        
        $testResponse = $service->addLevel($entityMock);
  
    }
    
}

