<?php

namespace GcoBundle\Service;

use GcoBundle\Entity\UserSkill;
use GcoBundle\DataFixture\UserSkillFixture;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use GcoBundle\Exceptions\InvalidParameterException;

class SkillService
{
    /**
     *
     * @var ValidatorInterface 
     */
    private $validator;
    /**
     *
     * @var UserSkillFixture 
     */
    private $skillFixture;
    /**
     *
     * @var integer 
     */
    private $userId = null;
    /**
     *
     * @var array
     */
    private $userSkills = array();
    
    /**
     * 
     * @param UserSkillFixture $skillFixture
     * @param ValidatorInterface $validator
     */
    public function __construct(UserSkillFixture $skillFixture, ValidatorInterface $validator)
    {
        $this->skillFixture = $skillFixture;
        $this->validator = $validator;        
    }
          
    /**
     * Add user skills
     * 
     * @param array $userSkills the user skills     
     */
    public function addSkill($userSkills = array())
    {             
        if (!is_array($userSkills) || count($userSkills) == 0) {
            return;
        }
        
        foreach($userSkills as $key => $userSkill) {            
            $this->prepare($userSkill);
        }
        
        if (count($this->userSkills) > 0) {
            $this->validateUserSkills();
            $this->skillFixture->addUserSkill($this->userSkills);      
        }
    }
    
     /**
     * Create a list of user skils of type \Entity\UserSkill
     * 
     * @param array $userSkills a list of skills
     */
    private function prepare($userSkills = array())
    {                
        if (is_array($userSkills) && count($userSkills) > 0 && intval($this->userId) > 0) {
            
            foreach ($userSkills as $technologyId => $levelId) {
                            $this->userSkills[] = new UserSkill(
                                                                $this->userId,
                                                                $technologyId,
                                                                $levelId
                                                       );
            }
        }
    }
    
    /**
     * Set the id of the user
     * 
     * @param integer $id user identifier
     */
    public function setUserId($id)
    {
        $this->userId = $id;
    }
    
    /**
     * Validate the user skills
     * 
     * @throws HttpException 
     */
    public function validateUserSkills()
    {
        foreach($this->userSkills as $key => $userSkill) {
            $errors = $this->validator->validate($userSkill);
            if(count($errors) > 0) {
                if ($errors->get(0)->getMessage() == "Technno not exisy") {
                    throw new TTException();
                } else 
                throw new InvalidParameterException('Invalid parameters :' . $errors->get(0)->getMessage());
            }
        }
    }
    
    //to be moved to technology service
    public function technologyExists($technologies = array())
    {
        $mockTechnologies = array(1,2,3,4,5,6,7);
        $result = array_intersect($mockTechnologies, $technologies);
        
        return count($technologies) == count($result);
        
    }
}
