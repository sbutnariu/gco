<?php

namespace GcoBundle\Entity;

/**
 * CoreTechnologies
 */
class CoreTechnologies
{
    /**
     * @var string
     */
    private $technology;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set technology
     *
     * @param string $technology
     *
     * @return CoreTechnologies
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

