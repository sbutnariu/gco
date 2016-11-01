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
        if(!empty ($coreTechnologyName)){
            $this->coreTechnologyService->setCoreTechnology($coreTechnologyName); // inlocuit cu serviciul (remove datafixture from controller)
        }
        else{
           return new Response('Technology Name', 400); 
        }
        return new Response('controller', 200);
    }
}
