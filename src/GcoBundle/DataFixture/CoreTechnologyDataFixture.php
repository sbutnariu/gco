<?php

namespace GcoBundle\DataFixture;

use Doctrine\ORM\EntityManager;
use GcoBundle\Entity\CoreTechnology;

class CoreTechnologyDataFixture{

    private $em;

    /**
    *
    * @param Registry $doctrine
    */
    public function __construct(EntityManager $entityManager)
    {
        $this->em =  $entityManager;
    }

     /**
     *
     * @param string $technologyName
     */
    public function saveCoreTechnology(CoreTechnology $coreTechnology)
    {
        $this->em->persist($coreTechnology);
        $this->em->flush();
    }

        /**
     * @param string $technologyName
     * @return null|CoreTechnology
     */
    public function getCoreTechnologyByName($technologyName){

        $connection = $this->em->getConnection();
        $statement = $connection->prepare("SELECT * FROM core_technology WHERE technology = :technology");
        $statement->bindValue('technology', $technologyName);
        $statement->execute();
        $results = $statement->fetchAll();

         $coreTechnology = new CoreTechnology();

        $coreTechnology->setTechnology($results);

        return $coreTechnology;

    }
}
