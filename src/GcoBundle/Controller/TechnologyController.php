<?php

namespace GcoBundle\Controller;

use GcoBundle\Exceptions\ExistsAlreadyException;
use GcoBundle\Factory\TechnologyFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\Service\TechnologyService;
use GcoBundle\Exceptions\WrongTypeException;
use GcoBundle\Exceptions\NotFoundException;
/**
 * Class TechnologyController
 * @package GcoBundle\Controller
 */
class TechnologyController
{
    /**
     * @var TechnologyService
     */
    private $service;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * TechnologyController constructor.
     * @param TechnologyService $service
     * @param SerializerInterface $serializer
     */
    public function __construct(TechnologyService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws BadRequestHttpException|NotFoundHttpException|ServiceUnavailableHttpException
     */
    public function getTechnologyAction(Request $request, $id)
    {
        try
        {
            $technology = $this->service->getTechnology($id);
        }
        catch (NotFoundException $e)
        {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }
        $jsonContent = $this->serializer->serialize($technology, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BadRequestHttpException|NotFoundHttpException|ServiceUnavailableHttpException
     */
    public function addTechnologyAction(Request $request)
    {
        $newTechnology =
            TechnologyFactory::create(
                array(
                    'coreTechnologyId' => $request->get("core_id"),
                    'technologyName' => $request->get("technology_name")
                )
        );
        try
        {
            $technology = $this->service->addTechnology($newTechnology);
        }
        catch (NotFoundException $e)
        {
            throw new NotFoundHttpException($e->getMessage());
        }
        catch (ExistsAlreadyException $e)
        {
            throw new ConflictHttpException($e->getMessage());
        }
        $jsonContent = $this->serializer->serialize($technology->getId(), JsonEncoder::FORMAT);
        return new Response(null, Response::HTTP_CREATED, array("ETag"=>$jsonContent));
    }
}
