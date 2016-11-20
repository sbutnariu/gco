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
    public function addCoreTechnologyAction(Request $request)
    {
        $content = $request->getContent();        
        $params = json_decode($content, true);
        $coreTechnologyName = $params['name'];             
        
        try{
            $this->coreTechnologyService->addCoreTechnology($coreTechnologyName);
        }
        catch (CoreTechnologyAlreadyExistsException $ex){
            return new Response('Technology'.$coreTechnologyName.' already in datebase', Response::HTTP_BAD_REQUEST);
        }
        
       return new Response('', Response::HTTP_NO_CONTENT);
    }
}
