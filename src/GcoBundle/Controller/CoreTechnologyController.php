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

echo $request->request->get('name');
        $this->dataFixture->setCoreTechnology($request->request->get('name')); // inlocuit cu serviciul (remove datafixture from controller)
        
        return new Response('controller', 200);
    }
}
