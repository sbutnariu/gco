<?php

namespace GcoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function getUserAction(Request $request, $id)
    {
        return new Response($id, 200);
    }
}
