<?php

namespace GcoBundle\Entity;

/**
 * Technologies
 */
class Technologies
{
    /**
     * @var integer
     */
    private $coreId;

    /**
     * @var string
     */
    private $technology;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set coreId
     *
     * @param integer $coreId
     *
     * @return Technologies
     */
    public function setCoreId($coreId)
    {
        $this->coreId = $coreId;

        return $this;
    }

    /**
     * Get coreId
     *
     * @return integer
     */
    public function getCoreId()
    {
        return $this->coreId;
    }

    /**
     * Set technology
     *
     * @param string $technology
     *
     * @return Technologies
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * Get technology
     *
     * @return string
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

