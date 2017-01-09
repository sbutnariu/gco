<?php

namespace GcoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use GcoBundle\Service\UserSkillService;
use GcoBundle\Serializer\UserSkillSerializer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GcoBundle\Exceptions\InvalidParametersException;
use GcoBundle\Exceptions\NotFoundException;

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
        try {
            $skillList = $this->service->getUserSkill($id);
            $formattedList = $this->normalizer->normalize($skillList);
            return new Response($formattedList,Response::HTTP_OK);
       
        } catch (InvalidParametersException $e) {
            throw new BadRequestHttpException($e->getErrorCode(), $e);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getErrorCode(), $e);
        }
    }
}
