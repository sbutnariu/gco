<?php

namespace GcoBundle\DataFixture;

use Doctrine\Bundle\DoctrineBundle\Registry;
use GcoBundle\Entity\Technology;

class TechnologyDataFixture
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * retrieve a technology list that contains in the name the word part given
     * @param Technology $technologyObj
     * @return array
     */
    public function getListOfTechnologies(Technology $technologyObj)
    {
        $technologyRepo = $this->doctrine->getRepository('GcoBundle:Technology');
        $technologyList = $technologyRepo->createQueryBuilder('t')
            ->where('t.technology LIKE :technology')
            ->setParameter('technology', '%'.$technologyObj->getTechnology().'%')
            ->getQuery()
            ->getResult();
        return $technologyList;
    }

}
