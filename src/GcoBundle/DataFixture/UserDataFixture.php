<?php

namespace GcoBundle\DataFixture;

use Symfony\Bridge\Doctrine;
use Doctrine\Bundle\DoctrineBundle\Registry;

class UserDataFixture
{
    private $doctrine;
    
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getUser($id)
    {
        $user = $this->doctrine
            ->getRepository('GcoBundle:User')
            ->find($id);

        return $user;
    }
}
