<?php

namespace GcoBundle\DataFixture;

use GcoBundle\Entity\Technology;
use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\DriverManager;

class TechnologyDataFixture
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;

    }

    public function getTechnology($id)
    {
        $technology = $this->doctrine
            ->getRepository('GcoBundle:Technology')
            ->find($id);

        return $technology;
    }

    public function addTechnology($coreTechnologyId, $technologyName)
    {
        $technology = new Technology();
        $technology->setCoreId($coreTechnologyId);
        $technology->setTechnology($technologyName);

        $em = $this->doctrine->getManager();
        $em->persist($technology);
        $em->flush();

        return $technology;
    }
}
