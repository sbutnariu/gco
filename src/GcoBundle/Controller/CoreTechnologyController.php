<?php
namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\DataFixture\CoreTechnologyDataFixture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CoreTechnologyController  extends Controller{ 
    
    private $dataFixture;
    public function __construct(CoreTechnologyDataFixture $dataFixture)
    {
        $this->dataFixture = $dataFixture;
    }


    public function addCoreTechnologyAction()
    { 
        $request = Request::createFromGlobals();
        $request->getPathInfo();


        $this->dataFixture->setCoreTechnology($request->request->get('name'));
        
        return new Response('controller', 200);
    }
}
