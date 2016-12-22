<?php

namespace GcoBundle\Factory;

use GcoBundle\Entity\Level;

class LevelFactory
{
    /**
     * Create a Level Entity with an Array given in parameter
     * @param array $level
     * @return Level
     */
    public function generateLevel(array $level)
    {
        $newLevel = new Level();
        
        $newArray = array(
            'id' => null,
            'label' => null
        );
        
        $arrayMergeResult = array_merge($newArray,$level);
        
        $newLevel->setId($arrayMergeResult['id']);
        $newLevel->setName($arrayMergeResult['label']);
        
        return $newLevel;
    }
}