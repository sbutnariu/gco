<?php

namespace GcoBundle\DataFixture;

use Doctrine\ORM\EntityManager;

class CoreTechnologyDataFixture{
    
    private $doctrine;
    
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
    public function setCoreTechnology($technologyName)
    {
        $coreTechnology = new CoreTechnology();
        $coreTechnology->setTechnology($technologyName);       
       
        $this->em->persist($coreTechnology);
        $this->em->flush();
        $this->em->clear();

        
    }
    
    /**
     * check if the core technology already exists in database
     *
     * @param string $technologyName
     */
    public function checkDuplicateCoreTechnology($technologyName){
        $isDuplicate = false;
        $connection = $this->em->getConnection();
        $statement = $connection->prepare("SELECT * FROM core_technology WHERE technology = :technology");        
        $statement->bindValue('technology', $technologyName);        
        $statement->execute();
        $results = $statement->fetchAll();
        if(!empty($results)){
            $isDuplicate = true;
        }
        
        return $isDuplicate;
        
    }
}
