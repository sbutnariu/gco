<?php
namespace GcoBundle\Factory;
use GcoBundle\Entity\Technology;
class TechnologyFactory
{
    /**
     * @param array $technologyArray
     * @return Technology
     */
    public static function create( array $technology)
    {
        $newTechnology = new Technology();

        if (isset($technology['coreTechnologyId'])) {
            $newTechnology->setCoreId($technology['coreTechnologyId']);
        }
        if (isset($technology['technologyName'])) {
            $newTechnology->setTechnology($technology['technologyName']);
        }

        return $newTechnology;
    }
}