<?php

namespace GcoBundle\DataFixture;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GcoBundle\Exception\IsNotNumericException;

class UserSkillDataFixture
{
    /**
     * @var Doctrine
     */
    private $doctrine;
    
    /**
     * UserSkillDataFixture constructor
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine) {
        $this->doctrine = $doctrine;
    }
    
    /**
     * Receive the user id, if it's Ok it returns the UserSkill entity, otherwise if the id is not a numeric value we have a 400 Exception, if the user doesn't exist we throw a 404 Exception
     * @param type $id
     * @return type
     * @throws IsNotNumericException
     * @throws NotFoundHttpException
     */
    public function getUserSkill($id)
    {
        if(!is_numeric($id)) {
            throw new IsNotNumericException();
        }
        
        $em = $this->doctrine->getManager();
        $userSkillEntity = $em->getRepository('GcoBundle:UserSkill')->findByuser_id($id);
        
        if(empty($userSkillEntity)) {
            throw new NotFoundHttpException('No data found for this User');
        }
        
        return $userSkillEntity;
    }
}

