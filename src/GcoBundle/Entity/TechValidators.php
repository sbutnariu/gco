<?php

namespace GcoBundle\Entity;

/**
 * TechValidators
 */
class TechValidators
{
    /**
     * @var integer
     */
    private $agencyId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $technologyId;


    /**
     * Set agencyId
     *
     * @param integer $agencyId
     *
     * @return TechValidators
     */
    public function setAgencyId($agencyId)
    {
        $this->agencyId = $agencyId;

        return $this;
    }

    /**
     * Get agencyId
     *
     * @return integer
     */
    public function getAgencyId()
    {
        return $this->agencyId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return TechValidators
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
     * @return TechValidators
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

