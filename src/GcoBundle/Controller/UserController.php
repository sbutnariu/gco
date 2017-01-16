<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\Service\UserService;

class UserController
{
    private $service;
    private $serializer;

    public function __construct(UserService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function getUserAction(Request $request, $id)
    {
        $user = $this->service->getUser($id);
        $jsonContent = $this->serializer->serialize($user, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }
}
