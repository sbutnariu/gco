<?php

namespace Tests\GcoBundle\Factory;

use GcoBundle\Factory\TechnologyFactory;

class TechnologyFactoryTest  extends\PHPUnit_Framework_TestCase
{

    public function providerCreateTechnology()
    {
        return array(
            array(
                array(
                    'core_id' => 5,
                    'technology' => 'java'
                )
            )
        );
    }

    /**
     * @dataProvider providerCreateTechnology
     */
    public function testCreateTechnology($technologyArray)
    {
        $technologyObj = TechnologyFactory::create($technologyArray);
        $this->assertEquals($technologyArray['core_id'], $technologyObj->getCoreId());
        $this->assertEquals($technologyArray['technology'], $technologyObj->getTechnology());
    }
}