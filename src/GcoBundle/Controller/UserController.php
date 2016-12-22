<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\DataFixture\UserDataFixture;

class UserController
{
    private $dataFixture;
    private $serializer;

    public function __construct(UserDataFixture $dataFixture, SerializerInterface $serializer)
    {
        $this->dataFixture = $dataFixture;
        $this->serializer = $serializer;
    }

    public function getUserAction(Request $request, $id)
    {
        $user = $this->dataFixture->getUser($id);
        $jsonContent = $this->serializer->serialize($user, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }
}