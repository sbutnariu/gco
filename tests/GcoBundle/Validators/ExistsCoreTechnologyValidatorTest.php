<?php

namespace Tests\GcoBundle\Validators;
use GcoBundle\Entity\Technology;
use GcoBundle\Validators\ExistsCoreTechnology;
use GcoBundle\Validators\ExistsCoreTechnologyValidator;


/**
 * Checks if the coreTechnologyId exists
 */
class ExistsCoreTechnologyValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testValidate()
    {
        $technology = new Technology();
        $technology->setCoreId(1);
        $technology->setTechnology('C');
        $serviceMock = $this->getMockBuilder('GcoBundle\Service\CoreTechnologyService')
            ->disableOriginalConstructor()
            ->getMock();
        $serviceMock->expects($this->any())
        ->method('getTechnology')
        ->will($this->returnValue($technology));
        $constraint = new ExistsCoreTechnology();
        $contextMock = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->getMock();
        $contextMock->expects($this->never())
            ->method('addViolation');

        $validator = new ExistsCoreTechnologyValidator( $serviceMock );
        $validator->initialize($contextMock);
        $validator->validate($technology, $constraint);
    }
}
