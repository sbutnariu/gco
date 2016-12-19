<?php

namespace GcoBundle\DataFixture;

use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;
use GcoBundle\Entity\Level;

class LevelDataFixture
{
    
    protected $doctrine;
    
    public function __construct(Registry $doctrine) {
        
        $this->doctrine = $doctrine;
    }
    
    
    
    public function addLevel(Level $level)
    {
        
        $em = $this->doctrine->getManager();
        
        $entityExist = $em->getRepository('GcoBundle:Level')->find($level->getId());
        
        
        if (null === $entityExist) {
            
            $em->persist($level);
             
            $metadata = $em->getClassMetaData(get_class($level));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
            
            $em->flush();
            
        }
               
        $em->merge($level);
        $em->flush();
        
    }
    
    
}