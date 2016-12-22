<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GcoBundle\Service\LevelService;
use GcoBundle\Factory\LevelFactory;

class LevelController
{
    /**
     * @var LevelService
     */
    private $levelService;
    /**
     * @var LevelFactory
     */
    private $levelFactory;

    /**
     * LevelController constructor
     * @param LevelService $levelService
     * @param LevelFactory $levelFactory
     */
    public function __construct(LevelService $levelService, LevelFactory $levelFactory)
    {
        $this->levelService = $levelService;
        $this->levelFactory = $levelFactory;
    }
    
    /**
     * We get the content of the Request, we create a Level object with this one, and we send the Level to the LevelService method
     * @param Request $request
     * @return Response, 204 if everything went well
     */
    public function addLevelAction(Request $request)
    {
        $contentData = json_decode($request->getContent(),true);
        
        $levelObject = $this->levelFactory->generateLevel($contentData);
        
        $this->levelService->addLevel($levelObject);
        
        return new Response ("",Response::HTTP_NO_CONTENT);
    }
}