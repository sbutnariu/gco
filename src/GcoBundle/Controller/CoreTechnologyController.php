<?php
namespace GcoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\Exceptions\InvalidParameterException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use GcoBundle\Entity\CoreTechnology;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;



class CoreTechnologyController  extends Controller{

    /** @var coreTechnologyService */
    private $coreTechnologyService;

    /**
     * @param CoreTechnologyService $coreTechnologyService
     */
    public function __construct(CoreTechnologyService $coreTechnologyService)
    {
        $this->coreTechnologyService = $coreTechnologyService;


    }

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {

       $coreTechnology = $this->createCoreTechnology($request);
       //$this->getTechnologyRoute();exit;
        try{
            $this->coreTechnologyService->addCoreTechnology($coreTechnology);
            return new Response("/technology/core/".$coreTechnology->getId(), Response::HTTP_CREATED);// to do: return get core technology route
        }
        catch (CoreTechnologyExists $ex ){
            throw new AlreadyExistException($ex->getMessage(),$ex);
        }
        catch (InvalidParameterException $ex){
            throw new BadRequestHttpException($ex->getMessage(),$ex);
        }


       return new Response('', Response::HTTP_NO_CONTENT);
    }

    public static function createCoreTechnology($request){
        $coreTechnology = new CoreTechnology();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $coreTechnology->setTechnology($params['name']);

        return $coreTechnology;
    }

    public function getTechnologyRoute(){
        // inject router in controller
       // $route = new Route('/foo', array('controller' => 'MyController'));

        // var_dump($this->get('router')->getRouteCollection());

    }
}
