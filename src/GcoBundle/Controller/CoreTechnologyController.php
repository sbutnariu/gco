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
        
        if(!$this->validateRequest($coreTechnologyName)){
            return new Response('Technology name empty', 400);
        }
            
        $this->coreTechnologyService->addCoreTechnology($coreTechnologyName);

        return new Response('Core technology "'.$coreTechnologyName.'" inserted ', 200);
       
    }
    public function validateRequest(){
        $result = false;
        
        if(!empty($coreTechnologyName)){
           $result = true;
        }
      
        return $result;

    }
}
