<?php

namespace Tests\GcoBundle\Service;

use GcoBundle\Service\UserSkillService;
use GcoBundle\Entity\UserSkill;

class UserSkillServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserSkill()
    {
        $dataFixturesMock = $this->getMockBuilder('GcoBundle\DataFixture\UserSkillDataFixture')
                ->disableOriginalConstructor()
                ->getMock();
        
        $userSkillEntityMock = $this->getMockBuilder('GcoBundle\Entity\UserSkill')
                ->disableOriginalConstructor()
                ->getMock();
        
        $id = 1;
        
        $dataFixturesMock->expects($this->once())
                ->method('getUserSkill')
                ->with($id)
                ->willReturn($userSkillEntityMock);
        
        $service = new UserSkillService($dataFixturesMock);
        
        $actualResponse = $service->getUserSkill($id);
        
        $expectedResponse = new UserSkill();
        
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
}

