<?php

namespace Tests\GcoBundle\Validators\NoDuplicateTechnologyValidatorTest;
use GcoBundle\Entity\Technology;
use GcoBundle\Validators\NoDuplicateTechnology;
use GcoBundle\Validators\NoDuplicateTechnologyValidator;


/**
 * Checks if the coreTechnologyId exists
 */
class NoDuplicateTechnologyValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testValidate()
    {

        $serviceMock = $this->getMockBuilder('GcoBundle\Service\TechnologyService')
            ->disableOriginalConstructor()
            ->getMock();
        $serviceMock->expects($this->any())
        ->method('getTechnologyId')
        ->will($this->returnValue(null));
        $constraint = new NoDuplicateTechnology();
        $contextMock = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->getMock();
        $contextMock->expects($this->never())
            ->method('addViolation');

        $validator = new NoDuplicateTechnologyValidator( $serviceMock );
        $validator->initialize($contextMock);
        $validator->validate(new Technology(), $constraint);
    }
}
