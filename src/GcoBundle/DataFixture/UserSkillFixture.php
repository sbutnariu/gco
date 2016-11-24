<?php

namespace GcoBundle\DataFixture;

use Doctrine\ORM\EntityManager;

class UserSkillFixture
{    
    private $em;
    
    /**
     * 
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em =  $entityManager;
    }
    
    /**
     * Save or edit a user skill into the database
     *      
     * @param array $userSkills an array of objects of type \Entity\UserSkill
     */
    public function addUserSkill($userSkills = array())
    {                
        if (is_array($userSkills) && count($userSkills) > 0) {
            foreach ($userSkills as $key => $obj) {
                if (is_a($obj, 'GcoBundle\Entity\UserSkill')) {
                    $this->em->merge($obj);
                    $this->em->flush();
                }                
            }
            $this->em->clear();
        }                        
    }
}

