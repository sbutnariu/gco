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
        
        $repoMock = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->setMethods(array('findByuser_id'))
                ->getMock();
        
        $repoMock->expects($this->once())
                ->method('findByuser_id')
                //->with($id)
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
    
    public function exceptionProvider()
    {
        return array(
            'IsNotNumericException' => array('GcoBundle\Exceptions\InvalidParametersException', 'WRONG_DATA_TYPE', 'p'),
            'NotFoundHttpException' => array('GcoBundle\Exceptions\NotFoundException', 'NO_DATA_FOUND', 0)
        );
    }
    
    /**
     * @dataProvider exceptionProvider
     */
    public function testGetUserSkillKo($e, $statusCode, $id)
    {
        $this->setExpectedException($e);
        
        $repoMock = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();
        
        $repoMock->expects($this->any())
                ->method('findByuser_id')
                ->with($id)
                ->will($this->throwException(New $e($statusCode,'test')));
        
        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock();
        
        $emMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($repoMock));
        
        $doctrineMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
                ->disableOriginalConstructor()
                ->getMock();
        
        $doctrineMock->expects($this->any())
                ->method('getManager')
                ->will($this->returnValue($emMock));
        
        $dt = new UserSkillDataFixture($doctrineMock);
        
        $actualResponse = $dt->getUserSkill($id);
        
        $this->assertEquals($statusCode, $actualResponse->getErrorCode());
    }
}


