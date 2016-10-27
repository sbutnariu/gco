<?php

namespace GcoBundle\Entity;

/**
 * UserSkill
 */
class UserSkill
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $technologyId;

    /**
     * @var integer
     */
    private $levelId;


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserSkill
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set technologyId
     *
     * @param integer $technologyId
     *
     * @return UserSkill
     */
    public function setTechnologyId($technologyId)
    {
        $this->technologyId = $technologyId;

        return $this;
    }

    /**
     * Get technologyId
     *
     * @return integer
     */
    public function getTechnologyId()
    {
        return $this->technologyId;
    }

    /**
     * Set levelId
     *
     * @param integer $levelId
     *
     * @return UserSkill
     */
    public function setLevelId($levelId)
    {
        $this->levelId = $levelId;

        return $this;
    }

    /**
     * Get levelId
     *
     * @return integer
     */
    public function getLevelId()
    {
        return $this->levelId;
    }
}

