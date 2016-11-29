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

    public function testAddCoreTechnology(CoreTechnology $coreTechnology)
    {

        $request = $this->createRequest();
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);

        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')->disableOriginalConstructor()->getMock();
        $serviceMock->expects($coreTechnologyEntity)
            ->method('addCoreTechnology')
            ->shouldBeCalledTimes(1)->willReturn(7);


        $coreTechnology = $this->createRequest();

        $errors = $this->validator->validate($coreTechnology);

        if (count($errors) > 0) {
            throw new InvalidParameterException('Invalid parameters :' . $errors->get(0)->getMessage());
        }
        // add technology to DB
        $this->dataFixture->setCoreTechnology($coreTechnology);

        return $coreTechnology;
    }


}
