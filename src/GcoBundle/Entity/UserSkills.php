<?php

namespace GcoBundle\Entity;

/**
 * UserSkills
 */
class UserSkills
{
    /**
     * @var integer
     */
    private $levelId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $technologyId;


    /**
     * Set levelId
     *
     * @param integer $levelId
     *
     * @return UserSkills
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

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserSkills
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
     * @return UserSkills
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
}

