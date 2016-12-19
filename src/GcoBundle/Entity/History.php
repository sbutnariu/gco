<?php

namespace GcoBundle\Entity;

/**
 * History
 */
class History
{
    /**
     * @var integer
     */
    private $levelId;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $statusId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $techId;


    /**
     * Set levelId
     *
     * @param integer $levelId
     *
     * @return History
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return History
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     *
     * @return History
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return History
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
     * Set techId
     *
     * @param integer $techId
     *
     * @return History
     */
    public function setTechId($techId)
    {
        $this->techId = $techId;

        return $this;
    }

    /**
     * Get techId
     *
     * @return integer
     */
    public function getTechId()
    {
        return $this->techId;
    }
}
