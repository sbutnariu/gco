<?php

namespace GcoBundle\Service;

use GcoBundle\DataFixture\UserSkillDataFixture;

class UserSkillService
{
    /**
     * @var DataFixture
     */
    private $dataFixture;
    
    /**
     * UserSkillService constructor
     * @param UserSkillDataFixture $dataFixture
     */
    public function __construct(UserSkillDataFixture $dataFixture) {
        $this->dataFixture = $dataFixture;
    }
    
    /**
     * Get the User id and send it to the dataFixture which will return an object or an exception
     * @param int $id
     * @return $this->dataFixture->getUserSkill($id)
     */
    public function getUserSkill($id)
    {
        return $this->dataFixture->getUserSkill($id);
    }
}

