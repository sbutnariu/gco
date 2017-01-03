<?php

use Symfony\Component\HttpFoundation\Request;
use GcoBundle\Controller\CoreTechnologyController;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
class CoreTechnologyDataFixtureTest extends \PHPUnit_Framework_TestCase {


    public function createRequest(){
        $coreTechnologyName= json_encode(array('name'=>'phpxxxx'));
        $request = new Request(array(), array(), array(), array(), array(), array(), $coreTechnologyName);

        return $request;
    }

    /**
     *
     * @param string $technologyName
     */
    public function testSetCoreTechnology()
    {
        $request = $this->createRequest();
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);

        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();
        $emMock->expects($this->any())
            ->method('persist');

        $emMock->expects($this->any())
            ->method('flush');

        $dataFixture = new CoreTechnologyDataFixture($emMock);
        $actualResponse = $dataFixture->saveCoreTechnology($coreTechnologyEntity);


        //$this->assertEquals($coreTechnologyEntity, $actualResponse);
        $this->assertEquals(null, $actualResponse);
    }
}
