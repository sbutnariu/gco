<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\DataFixture\TechnologyDataFixture;

class TechnologyController
{
    private $dataFixture;
    private $serializer;

    public function __construct(TechnologyDataFixture $dataFixture, SerializerInterface $serializer)
    {
        $this->dataFixture = $dataFixture;
        $this->serializer = $serializer;
    }

    public function getTechnologyAction(Request $request, $id)
    {
        $technology = $this->dataFixture->getTechnology($id);
        $jsonContent = $this->serializer->serialize($technology, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }

    public function addTechnologyAction(Request $request)
    {
        $coreTechnologyId = $request->get("core_id");
        $technologyName = $request->get("technology_name");
        $technology = $this->dataFixture->addTechnology($coreTechnologyId, $technologyName);
        $jsonContent = $this->serializer->serialize($technology, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }
}
