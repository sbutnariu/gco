<?php

namespace GcoBundle\Entity;

/**
 * CoreTechnology
 */
class CoreTechnology
{
    /**
     * @var integer
     */
    private $id;

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
     * Set technology
     *
     * @param string $technology
     *
     * @return CoreTechnology
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
