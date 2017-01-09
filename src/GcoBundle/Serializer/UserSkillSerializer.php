<?php

namespace GcoBundle\Serializer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use GcoBundle\Entity\UserSkill;

class UserSkillSerializer implements NormalizerInterface
{
    /**
     * This method takes the UserSkill entity in parameter and return a well formated Json.
     * @param type $datas
     * @param type $format
     * @param array $context
     * @return type
     */
    public function normalize($datas = array(), $format = null, array $context = array())
    {
        $container = array();
        $skillList = array();
        
        foreach($datas as $data)
        {
            $technologyId = $data->getTechnologyId();
            $levelId = $data->getLevelId();
            
            $container = array(
                $technologyId => $levelId
            );      
            
            $skillList = $skillList + $container;
        }
            return json_encode($skillList);
    }
    
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof UserSkill;
    }
}