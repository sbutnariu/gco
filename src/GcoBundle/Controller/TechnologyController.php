<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\Service\TechnologyService;
class TechnologyController
{
    private $technologyService;
    private $serializer;

    public function __construct(TechnologyService $technologyService, SerializerInterface $serializer)
    {
        $this->technologyService = $technologyService;
        $this->serializer = $serializer;
    }

    /**
     * get list of technology
     * @param $request
     * @param $technology
     * @return Response
     */
    public function getListTechnologiesAction(Request $request, $technology)
    {
        $list = $this->technologyService->getListOfTechnologies($technology);
        $jsonContent = $this->serializer->serialize($list, JsonEncoder::FORMAT);
        return new Response($jsonContent, Response::HTTP_OK);
    }
}
