<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\Service\TechnologyService;

class TechnologyController
{
    private $service;
    private $serializer;

    public function __construct(TechnologyService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function getTechnologyAction(Request $request, $id)
    {
        $technology = $this->service->getTechnology($id);
        $jsonContent = $this->serializer->serialize($technology, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }

    public function addTechnologyAction(Request $request)
    {
        $newTechnology = array(
            'coreTechnologyId' => $request->get("core_id"),
            'technologyName' => $request->get("technology_name")
        );
        $technology = $this->service->addTechnology($newTechnology);
        $jsonContent = $this->serializer->serialize($technology, JsonEncoder::FORMAT);
        return new Response(null, Response::HTTP_CREATED, array("ETag"=>$jsonContent));
    }
}
