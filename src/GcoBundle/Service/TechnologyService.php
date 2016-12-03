<?php

namespace GcoBundle\Service;

use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Factory\TechnologyFactory;

class TechnologyService
{
    private $technologyDataFixture;

    public function __construct( TechnologyDataFixture $technologyDataFixture )
    {
        $this->technologyDataFixture = $technologyDataFixture;
    }

    /**
     * list of technology or empty array
     * @param $technologyName
     * @return array
     */
    public function getListOfTechnologies($technologyName)
    {

        $technologyObj = TechnologyFactory::create(array('technology' => $technologyName));
        $listOfTechnology = $this->technologyDataFixture->getListOfTechnologies($technologyObj);

        return $listOfTechnology;
    }
}

