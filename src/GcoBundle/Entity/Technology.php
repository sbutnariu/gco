<?php

namespace GcoBundle\Entity;

/**
 * Technology
 */
class Technology
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $coreId;

    /**
     * @var string
     */
    private $technology;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set coreId
     *
     * @param integer $coreId
     *
     * @return Technology
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
     * @return Technology
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
}

