<?php
namespace GcoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use GcoBundle\Entity\CoreTechnology;
use Symfony\Component\DependencyInjection\ContainerInterface;


class CoreTechnologyController extends Controller{

    /** @var coreTechnologyService */
    private $coreTechnologyService;

    /**
     * @param CoreTechnologyService $coreTechnologyService
     */
    public function __construct(CoreTechnologyService $coreTechnologyService, ContainerInterface $container)
    {
        $this->coreTechnologyService = $coreTechnologyService;
        $this->container = $container;
    }

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $coreTechnology = $this->createCoreTechnology($request);

        $this->coreTechnologyService->addCoreTechnology($coreTechnology);
        $coreTechnologyRoute = $this->generateUrl('gco_core_technology');
        return new Response($coreTechnologyRoute.'/'.$coreTechnology->getId(), Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function getCoreTechnologyById($id)
    {
        $coreTechnology = $this->coreTechnologyService->getCoreTechnologyById($id);
        $params = json_encode($coreTechnology->getTechnology(), true);

        return new Response($params, Response::HTTP_OK);
    }

    public static function createCoreTechnology($request)
    {
        $coreTechnology = new CoreTechnology();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $coreTechnology->setTechnology($params['name']);

        return $coreTechnology;
    }
}
