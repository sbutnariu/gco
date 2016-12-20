<?php

namespace Tests\GcoBundle\Service;

use GcoBundle\Service\LevelService;
use GcoBundle\Entity\Level;

class LevelServiceTest extends \PHPUnit_Framework_TestCase
{
    
    public function testAddLevel()
    {
        
        $dataFxMock = $this->getMockBuilder('GcoBundle\DataFixture\LevelDataFixture')
                ->disableOriginalConstructor()
                ->getMock();
        
        $dataFxMock->expects($this->once())
                ->method('addLevel')
                ->will($this->returnValue(new Level()));
        
        $service = new LevelService($dataFxMock);
        
        $expectedResponse = new Level();
        
        $actualResponse = $service->addLevel(new Level());
        
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
        
    }
    
}

