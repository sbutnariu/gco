<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\UserSkillController;

class UserSkillControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserSkillOk()
    {
        $entityMock = $this->getMockBuilder('GcoBundle\Entity\UserSkill')
                ->disableOriginalConstructor()
                ->getMock();
        
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\userSkillService')
                ->disableOriginalConstructor()
                ->getMock();
        
        $serviceMock->expects($this->once())
                ->method('getUserSkill')
                ->willReturn($entityMock);
        
        $normalizerMock = $this->getMockBuilder('GcoBundle\Serializer\UserSkillSerializer')
                ->getMock();
        
        $normalizerMock->expects($this->once())
                ->method('normalize');
        
        $ctrl = new UserSkillController($serviceMock, $normalizerMock);
        
        $id = 1;
        
        $actualResponse = $ctrl->getUserSkillAction($id);
        
        $this->assertEquals(200, $actualResponse->getStatusCode());
    }
    
    public function exceptionProvider()
    {
        return array(
            'IsNotNumericException' => array('GcoBundle\Exception\IsNotNumericException', 400, 'p', 'Symfony\Component\HttpKernel\Exception\BadRequestHttpException'),
            'NotFoundHttpException' => array('Symfony\Component\HttpKernel\Exception\NotFoundHttpException', 404, 0, 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException')
        );
    }
    
    /**
     * @dataProvider exceptionProvider
     */
    public function testGetUserSkillKo($e, $statusCode, $id, $ctrlException)
    {
        $this->setExpectedException($ctrlException);
        
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\userSkillService')
                ->disableOriginalConstructor()
                ->getMock();
        
        $serviceMock->expects($this->once())
                ->method('getUserSkill')
                ->will($this->throwException(New $e));
        
        $normalizerMock = $this->getMockBuilder('GcoBundle\Serializer\UserSkillSerializer')
                ->getMock();
        
        $normalizerMock->expects($this->never())
                ->method('normalize');
        
        $ctrl = new UserSkillController($serviceMock, $normalizerMock);
        
        $actualResponse = $ctrl->getUserSkillAction($id);
        
        $this->assertEquals($statusCode, $actualResponse->getStatusCode());
    }
}

