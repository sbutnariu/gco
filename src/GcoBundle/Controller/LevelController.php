<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use GcoBundle\DataFixture\UserDataFixture;
use GcoBundle\Service\LevelService;
use GcoBundle\Factory\LevelFactory;

class LevelController
{

    private $levelService;
    private $levelFactory;


    public function __construct(LevelService $levelService, LevelFactory $levelFactory)
    {
        $this->levelService = $levelService;
        $this->levelFactory = $levelFactory;
    }
    
    
    public function addLevelAction(Request $request)
    {
        $contentData = json_decode($request->getContent(),true);
        
        $levelObject = $this->levelFactory->generateLevel($contentData);
        
        $this->levelService->addLevel($levelObject);
        
        return new Response ("",Response::HTTP_NO_CONTENT);
    }
 
}
