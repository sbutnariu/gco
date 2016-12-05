<?php
use Doctrine\ORM\EntityManager;
use GcoBundle\Entity\CoreTechnology;

class CoreTechnologyDataFixtureTest {


         /**
     *
     * @param string $technologyName
     */
    public function setCoreTechnology(CoreTechnology $coreTechnology)
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();

        $em->persist($coreTechnology);

    }

    /**
     * check if the core technology already exists in database
     *
     * @param string $technologyName
     */
   public function getTechnologyByName($technologyName){

        $connection = $this->em->getConnection();
        $statement = $connection->prepare("SELECT * FROM core_technology WHERE technology = :technology");
        $statement->bindValue('technology', $technologyName);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;

    }
}
