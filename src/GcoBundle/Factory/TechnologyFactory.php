<?php

namespace GcoBundle\Factory;

use GcoBundle\Entity\Technology;

class TechnologyFactory
{

    /**
     * @param array $technologyArray
     * @return Technology
     */
    public static function create( array $technologyArray)
    {
        $technologyObj = new Technology();

        if (isset($technologyArray['core_id'])) {
            $technologyObj->setCoreId($technologyArray['core_id']);
        }
        if (isset($technologyArray['technology'])) {
            $technologyObj->setTechnology($technologyArray['technology']);
        }
        return $technologyObj;
    }
}