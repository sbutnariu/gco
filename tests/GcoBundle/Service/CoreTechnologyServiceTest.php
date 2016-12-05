<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreTechnologyServiceTest
 *
 * @author ckozma
 */
class CoreTechnologyServiceTest extends \PHPUnit_Framework_TestCase {

    public function createRequest(){
        $coreTechnologyName = 'php';
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);
        $request= json_encode($request);

        return $request;
    }

    public function testAddCoreTechnology()
    {
        $request = $this->createRequest();
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);
        $dataFixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        $validatorMock = $this->getMockBuilder('GcoBundle\Exceptions\InvalidParameterException')->disableOriginalConstructor()->getMock();



        $service = new CoreTechnologyService($dataFixtureMock, $validatorMock);
        $actualResponse = $service->addCoreTechnology($coreTechnologyEntity);

          $validatorMock->expects($coreTechnologyEntity)
            ->method('addCoreTechnology')
            ->shouldBeCalledTimes(1)->willReturn(201);

        $this->assertEquals($coreTechnologyEntity, $actualResponse);
    }


}
