<?php

namespace GcoBundle\Service;


class UserService
{
    
    public function __construct()
    {
        
    }

    public function getUser($id)
    {
        return new Response($id, 200);
    }
}
