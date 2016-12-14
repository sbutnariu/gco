<?php

namespace GcoBundle\DataFixture;

use GcoBundle\Entity\Technology;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Class TechnologyDataFixture
 * @package GcoBundle\DataFixture
 */
class TechnologyDataFixture
{
    /**
     * @var Registry
     */
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
     * @return null|int
     */
    public function getTechnologyId($technology)
    {
        $technologies = $this->doctrine
            ->getRepository('GcoBundle:Technology')
            ->findBy(
                array('coreId' => $technology->getCoreId(),'technology' => $technology->getTechnology())
            );

        return (count($technologies)>0)?$technologies[0]->getId():null;
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
