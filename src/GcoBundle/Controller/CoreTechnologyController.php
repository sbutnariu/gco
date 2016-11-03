<?php
namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CoreTechnologyController  extends Controller{ 
    
    private $coreTechnologyService;
    public function __construct(CoreTechnologyService $coreTechnologyService)
    {
        $this->coreTechnologyService = $coreTechnologyService;
    }


    public function addCoreTechnologyAction()
    {         
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $coreTechnologyName = $request->request->get('name');
        $this->validateRequest($coreTechnologyName);
        if(!empty($coreTechnologyName)){
            $this->coreTechnologyService->setCoreTechnology($coreTechnologyName);
             return new Response('Core technology "'.$coreTechnologyName.'" inserted ', 200);
        }
        else{
           return new Response('Technology name empty', 400); 
        }
       
    }
    public function validateRequest(){
        
    }
}
