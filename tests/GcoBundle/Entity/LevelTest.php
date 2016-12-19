<?php

namespace Tests\GcoBundle\Entity;

use GcoBundle\Entity\Level;

class LevelTest extends \PHPUnit_Framework_TestCase
{
    public function testsetName()
    {
        $level = new Level();
        
        $level->setName("Thomas");
        
        $this->assertEquals('Thomas', $level->getName());
    }
}
