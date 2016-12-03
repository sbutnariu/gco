<?php

namespace Tests\GcoBundle\Controller;

use GcoBundle\Controller\TechnologyController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TechnologyControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TechnologyController
     */
    private $controller;
    private $serviceMock;
    private $serializerMock;


    public function setUp()
    {
        $this->serviceMock = $this->getMockBuilder('GcoBundle\Service\TechnologyService')
            ->disableOriginalConstructor()
            ->getMock();
        $this->serializerMock = $this->getMockBuilder('Symfony\Component\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new TechnologyController($this->serviceMock, $this->serializerMock);
    }

    public function providerGetTechnology()
    {
        return array(
            array(
                array(
                    'id' => 1,
                    'core_id' => 2,
                    'technology' => 'javascript'
                )
            )
        );
    }

    /**
     * @dataProvider providerGetTechnology
     * @param $technologyArray
     */
    public function testGetListTechnologies($technologyArray)
    {
        $this->serializerMock->expects($this->any())
            ->method('serialize')
            ->will($this->returnValue(json_encode($technologyArray)));

        $request = new Request(array(), array(), array(), array(), array(), array(), json_encode($technologyArray));

        $actualResponse = $this->controller->getListTechnologiesAction($request, $technologyArray['technology']);
        $this->assertEquals(Response::HTTP_OK, $actualResponse->getStatusCode());
    }
}