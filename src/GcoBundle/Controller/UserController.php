<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\UserDataFixture;

class UserController
{
    private $dataFixture;
    public function __construct(UserDataFixture $dataFixture)
    {
        $this->dataFixture = $dataFixture;
    }

    public function getUserAction(Request $request, $id)
    {
        $user = $this->dataFixture->getUser($id);
        var_dump($user);
        return new Response($id, 200);
    }
}
