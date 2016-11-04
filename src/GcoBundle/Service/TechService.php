<?php

namespace GcoBundle\Service;
use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Validator\Validator;

class TechService
{
    private $validator;
    private $technologyDataFixture;

    public function __construct( Validator $validator, TechnologyDataFixture $technologyDataFixture )
    {
        $this->validator = $validator;
        $this->technologyDataFixture = $technologyDataFixture;
    }

    public function getListOfTechnologies($technology)
    {
        $validator = Validator::validateTechnology($technology);
        if(!is_array($validator)) {
            $listOfTechnology = $this->technologyDataFixture->getListOfTechnologies($technology);
            if(empty($listOfTechnology)) {
                return Validator::validateTechnology($technology, $listOfTechnology);
            }
            return $listOfTechnology;
        }
        return $validator;
    }
}
