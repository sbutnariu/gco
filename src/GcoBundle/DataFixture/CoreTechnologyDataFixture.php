<?php

namespace GcoBundle\DataFixture;


use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;
use GcoBundle\Entity\CoreTechnology;


class CoreTechnologyDataFixture{
    
    private $doctrine;
    
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setCoreTechnology($technologyName)
    {       
        $coreTechnology = new CoreTechnology();
        $coreTechnology->setTechnology($technologyName);       
        $em = $this->doctrine->getManager();
        $em->persist($coreTechnology);
        $em->flush();

       // return new Response('Saved new technology with id '.$coreTechnology->getId());
        
    }
    public function checkDuplicateCoreTechnology($technologyName){
        $isDuplicate = false;
        $em = $this->doctrine->getManager();
        $connection = $em->getConnection();
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
