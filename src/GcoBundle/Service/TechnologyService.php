<?php

namespace GcoBundle\Service;


class TechnologyService
{
    
    public function __construct()
    {
        
    }

    public function getTechnology($id)
    {
        return new Response($id, 200);
    }
}
