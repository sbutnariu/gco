<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\CoreTechnologyController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CoreTechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function createRequest(){
        $coreTechnologyName = 'php';
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $request= json_encode($request);

        return $request;
    }
    public function testAddAction()
    {
        $coreTechnologyName= json_encode(array('name'=>'php'));
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($this->any())->method('addCoreTechnology')->willReturn(201);// will be call once

        $dao = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        $dao->expects($this->any())->method('saveCoreTechnology')->willReturn(201);// will be call once

        $ctrl = new CoreTechnologyController($serviceMock);
        $actualResponse = $ctrl->addAction($request);
        $this->assertEquals(201, $actualResponse->getStatusCode());
    }

    public function testAddActionTechnologyExist()
    {
        $coreTechnologyName= json_encode(array('name'=>'php'));
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')->disableOriginalConstructor()->getMock();
        $validator->expects($this->any())->method('validate')->willReturn(2);// o sa returneze error count > 0s


        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($this->any())->method('addCoreTechnology')->willReturn(201);// shold throw exception

        $dao = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        //$dao->expects($this->any())->method('saveCoreTechnology')->willReturn(201);// should not be called
        $dao->expects( $this->never() )->method( 'saveCoreTechnology' );

        $ctrl = new CoreTechnologyController($serviceMock);
        $actualResponse = $ctrl->addAction($request);
        $this->assertEquals(201, $actualResponse->getStatusCode());
    }

}
