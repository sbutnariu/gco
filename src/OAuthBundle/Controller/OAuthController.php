<?php

namespace OAuthBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\OAuth2\Server\Exception\InvalidAccessTokenException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class OAuthController
{
    private $loginService;

    public function __construct($loginService)
    {
        $this->loginService = $loginService;
    }

    public function postAccessTokenAction(Request $request)
    {
        try {
            $arrAccessToken = $this->loginService->getAccessToken($request);
        } catch (InvalidAccessTokenException $e) {
            throw new UnauthorizedHttpException($e->getMessage(), $e);
        }
        return new Response(json_encode($arrAccessToken), Response::HTTP_OK);
    }

    /*
    public function deleteAccesstokenWithTokenAction($accessToken)
    {
        // FIXME security: limit call/s on oauth URI !!
        $this->loginService->deleteTokenWithToken($accessToken);
        $view = View::create(null, Response::HTTP_NO_CONTENT);

        return $view;
    }*/

    /**
     * @Delete("/accesstokens", name="delete_access_token", options={ "method_prefix" = false })
     * @return View
     * @Secure(roles="ROLE_MEMBER")
     */
    public function deleteAccesstokensAction()
    {
        $this->get('ilius_oauth.resource_server')->deleteToken();
        $view = View::create(null, Response::HTTP_NO_CONTENT);

        return $view;
    }
}
