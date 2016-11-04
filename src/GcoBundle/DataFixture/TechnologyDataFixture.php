<?php

namespace GcoBundle\DataFixture;

use Doctrine\Bundle\DoctrineBundle\Registry;

class TechnologyDataFixture
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getListOfTechnologies($technology)
    {
        $technologyRepo = $this->doctrine->getRepository('GcoBundle:Technology');
        $technologyList = $technologyRepo->createQueryBuilder('t')
            ->where('t.technology LIKE :technology')
            ->setParameter('technology', '%'.$technology.'%')
            ->getQuery()
            ->getResult();

        return $technologyList;
    }

}
