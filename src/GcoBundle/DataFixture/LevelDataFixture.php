<?php

namespace GcoBundle\DataFixture;

use Doctrine\Bundle\DoctrineBundle\Registry;
use GcoBundle\Entity\Level;

class LevelDataFixture
{
    /**
     * @var Registry
     */
    protected $doctrine;
    
    /**
     * LevelDataFixture constructor
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    /**
     * Create or Update a Level if this one exist or not in the database
     * @param Level $level
     * @return Level
     */
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
            return $level;
        }
        $em->merge($level);
        $em->flush();
        return $level;
    }
}