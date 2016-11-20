<?php

namespace GcoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use GcoBundle\Service\SkillService;
use GcoBundle\Exceptions\InvalidParameterException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends Controller
{
    /**
     *
     * @var SkillService 
     */
    private $skillService;        
    /**
     *
     * @var array 
     */
    private $userSkills = array();
    /**
     *
     * @var integer 
     */
    private $userId = null;
    
    /**    
     * @param SkillService $skill     
     */
    public function __construct(SkillService $skill)
    {
        $this->skillService = $skill;
    }
    
    /**
     * Adds a set of skills to the user
     * 
     * @param Request $request the data body of the request
     * @param integer $id user identifier
     * @throws HttpException 
     */
    public function addAction(Request $request, $id)
    {                
        $contentData = json_decode($request->getContent(), true);        
        
        if (is_null($contentData) || count($contentData) == 0) {
            throw new BadRequestHttpException('Request body contains invalid data');
        }
                
        try {
            
            $this->skillService->setUserId(intval($id));
            $this->skillService->addSkill($contentData);
            
        } catch (InvalidParameterException $ex){            
            throw new BadRequestHttpException($ex->getMessage(), $ex);
        } 
        
        return new Response('', Response::HTTP_NO_CONTENT);

    }    
}

