<?php
namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\Service\CoreTechnologyService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;




class CoreTechnologyController  extends Controller{ 
    
    private $coreTechnologyService;
    
    public function __construct(CoreTechnologyService $coreTechnologyService)
    {
        $this->coreTechnologyService = $coreTechnologyService;
    }


    public function addCoreTechnologyAction(Request $request)
    {
        $content = $request->getContent();        
        $params = json_decode($content, true);
        $coreTechnologyName = $params['name'];
        
        $validator = Validation::createValidator();        
        $errors = $validator->validate($coreTechnologyName, array(new NotBlank()));
        
        if (count($errors) > 0) {
           $errorsString = (string) $errors;
            return new Response($errorsString,Response::HTTP_BAD_REQUEST);
        }
            
        $this->coreTechnologyService->addCoreTechnology($coreTechnologyName);

        return new Response('Core technology "'.$coreTechnologyName.'" inserted ', Response::HTTP_CREATED);
       
    }
}
