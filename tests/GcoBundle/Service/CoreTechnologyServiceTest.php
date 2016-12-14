<?php

use GcoBundle\Controller\CoreTechnologyController;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of CoreTechnologyServiceTest
 *
 * @author ckozma
 */
class CoreTechnologyServiceTest extends \PHPUnit_Framework_TestCase {

    public function createRequest(){
        $coreTechnologyName= json_encode(array('name'=>'php'));
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        return $request;
    }

    public function testAddCoreTechnology()
    {
        $request = $this->createRequest();
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);
        $dataFixtureMock = $this->getMockBuilder('GcoBundle\DataFixture\CoreTechnologyDataFixture')->disableOriginalConstructor()->getMock();
        $validatorMock = $this->getMockBuilder('GcoBundle\Exceptions\InvalidParameterException')->disableOriginalConstructor()->getMock();


         $validatorMock->expects($coreTechnologyEntity)
                        ->method('validate')
                        ->shouldBeCalledTimes(1)->willReturn(201);

          $dataFixtureMock->expects($coreTechnologyEntity)
                        ->method('saveCoreTechnology')
                        ->shouldBeCalledTimes(1)->willReturn(201);

        $service = new CoreTechnologyService($dataFixtureMock, $validatorMock);
        $actualResponse = $service->addCoreTechnology($coreTechnologyEntity);


        $this->assertEquals($coreTechnologyEntity, $actualResponse);
    }


}
