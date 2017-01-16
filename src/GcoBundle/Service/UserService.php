<?php

namespace GcoBundle\Service;

use Doctrine\ORM\NoResultException;
use GcoBundle\DataFixture\UserDataFixture;

class UserService
{
    private $dataFixture;

    public function __construct(UserDataFixture $dataFixture)
    {
        $this->dataFixture = $dataFixture;
    }

    public function getUser($id)
    {
        $user = $this->dataFixture->getUser($id);
        if(!empty($user))
            return $user;
        else{
            throw new NoResultException('No user with id '.$id.' found');
        }
    }
}
