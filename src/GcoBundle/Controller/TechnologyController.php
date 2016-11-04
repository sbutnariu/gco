<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\Service\TechService;

class TechnologyController
{
    private $technologyService;
    private $serializer;

    public function __construct(TechService $technologyService, SerializerInterface $serializer)
    {
        $this->technologyService = $technologyService;
        $this->serializer = $serializer;
    }

    public function getListTechnologiesAction(Request $request, $technology)
    {
        $list = $this->technologyService->getListOfTechnologies($technology);
        $jsonContent = $this->serializer->serialize($list, JsonEncoder::FORMAT);

        return new Response($jsonContent);
    }
}
