<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use GcoBundle\Service\UserSkillService;
use GcoBundle\Serializer\UserSkillSerializer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserSkillController
{
    /**
     * @var Service
     */
    private $service;
    /**
     * @var Normalizer
     */
    private $normalizer;

    /**
     * UserSkillController constructor
     * @param UserSkillService $service
     * @param UserSkillSerializer $normalizer
     */
    public function __construct(UserSkillService $service, UserSkillSerializer $normalizer) 
    {
        $this->service = $service;
        $this->normalizer = $normalizer;
    }
    
    /**
     * The constructor take the user id in parameter then it will return the skills list or an exception
     * @param int $id
     * @return Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function getUserSkillAction($id)
    {
        $skillList = $this->service->getUserSkill($id);
        $formattedList = $this->normalizer->normalize($skillList);
        return new Response($formattedList,Response::HTTP_OK);
    }
}
