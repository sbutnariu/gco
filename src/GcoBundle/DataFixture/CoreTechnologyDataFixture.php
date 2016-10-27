<?php

namespace GcoBundle\DataFixture;


use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;
use GcoBundle\Entity\CoreTechnologies;


class CoreTechnologyDataFixture{
    
    private $doctrine;
    
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setCoreTechnology($technologyName)
    {       
        $coreTechnology = new CoreTechnologies();
        $coreTechnology->setTechnology($technologyName);       
        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($coreTechnology);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

       // return new Response('Saved new technology with id '.$coreTechnology->getId());
        
    }
}
