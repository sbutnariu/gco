<?php

namespace GcoBundle\DataFixture;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GcoBundle\Exceptions\InvalidParametersException;
use GcoBundle\Exceptions\NotFoundException;

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
     * @param int $id
     * @return UserSkillEntity
     * @throws InvalidParametersException
     * @throws NotFoundException
     */
    public function getUserSkill($id)
    {
        if(!is_numeric($id)) {
            throw new InvalidParametersException(InvalidParametersException::WRONG_DATA_TYPE, InvalidParametersException::MESSAGE);
        }
        
        $em = $this->doctrine->getManager();
        $repo= $em->getRepository('GcoBundle:UserSkill');
        $userSkillEntity = $repo->findByuser_id($id);
        
        if(empty($userSkillEntity)) {
            throw new NotFoundException(NotFoundException::NO_DATA_FOUND, NotFoundException::MESSAGE);
        }
        return $userSkillEntity;
    }
}

