<?php

namespace GcoBundle\DataFixture;

use GcoBundle\Entity\Technology;
use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\DriverManager;

/**
 * Class TechnologyDataFixture
 * @package GcoBundle\DataFixture
 */
class TechnologyDataFixture
{
    private $doctrine;

    /**
     * TechnologyDataFixture constructor.
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;

    }

    /**
     * @param $id
     * @return null|Technology
     */
    public function getTechnology($id)
    {
        $technology = $this->doctrine
            ->getRepository('GcoBundle:Technology')
            ->find($id);

        return $technology;
    }

    /**
     * @param Technology $technology
     * @return Technology
     */
    public function addTechnology(Technology $technology)
    {
        $em = $this->doctrine->getManager();
        $em->persist($technology);
        $em->flush();

        return $technology;
    }
}
