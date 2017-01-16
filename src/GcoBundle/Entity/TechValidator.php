<?php

namespace GcoBundle\Entity;

/**
 * TechValidator
 */
class TechValidator
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
    private $agencyId;


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return TechValidator
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
     * @return TechValidator
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
     * Set agencyId
     *
     * @param integer $agencyId
     *
     * @return TechValidator
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
}
