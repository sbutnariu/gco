<?php

namespace GcoBundle\Service;


class CoreTechnologyService {
    
    public function __construct()
    {
        
    }

    public function getCoreTechnology($name)
    {
        return new Response("service", 200);
    }
}
