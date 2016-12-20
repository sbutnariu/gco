<?php

namespace GcoBundle\Factory;

use GcoBundle\Entity\Level;

class LevelFactory
{
    
    public function generateLevel(array $level)
    {
        $newLevel = new Level();
        
        if(isset($level['id'])){
            $newLevel->setId($level['id']);
        }
        
        if(isset($level['label'])){
            $newLevel->setName($level['label']);
        }
        
        return $newLevel;
    }
    
}