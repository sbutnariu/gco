<?php

namespace Tests\GcoBundle\DataFixture;

use GcoBundle\DataFixture\UserSkillDataFixture;
use GcoBundle\Entity\UserSkill;


class UserSkillDataFixtureTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserSkill()
    {
        $id = 1;
        
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\UserSkill')
                ->disableOriginalConstructor()
                ->getMock();
        
        $repoMock = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();
        
        $repoMock->expects($this->once())
                ->method('findByuser_id')
                ->with($id)
                ->will($this->returnValue($entityMock));
        
        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock();
        
        $emMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($repoMock));
        
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
                ->disableOriginalConstructor()
                ->getMock();
        
        $doctrineMock->expects($this->once())
                ->method('getManager')
                ->will($this->returnValue($emMock));
        
        $dt = new UserSkillDataFixture($doctrineMock);
        
        $expectedResponse = new UserSkill();
        
        $actualResponse = $dt->getUserSkill($id);
        
        $this->assertInstanceOf(get_class($expectedResponse), $actualResponse);
    }
}

