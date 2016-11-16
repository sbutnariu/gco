<?php

namespace OAuthBundle\Services;

use Ilius\Bundle\OAuthBundle\Security\Provider\OAuthProvider;
use OAuthBundle\Token\OAuthToken;
use League\OAuth2\Server\Authorization;
use League\OAuth2\Server\Exception\ClientException;
use League\OAuth2\Server\Util\Request as OAuthRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class LoginService
{
    /**
     * @var Authorization
     */
    private $authorization;

    /**
     * @var OAuthProvider
     */
    private $oauthProvider;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @param Authorization $authorization
     * @param OAuthProvider $oauthProvider
     * @param TokenStorage $tokenStorage
     */
    public function __construct(
        Authorization $authorization,
        OAuthProvider $oauthProvider,
        TokenStorage $tokenStorage
    ) {
        $this->authorization = $authorization;
        $this->oauthProvider = $oauthProvider;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getAccessToken(Request $request)
    {
        $oauthRequest = new OAuthRequest(
            $request->query->all(),
            $request->request->all(),
            $request->cookies->all(),
            $request->files->all(),
            $request->server->all(),
            $request->headers->all()
        );

        $this->authorization->setRequest($oauthRequest);
        $arrAccessToken = $this->authorization->issueAccessToken();


        $request->server->set('HTTP_AUTHORIZATION', 'Bearer ' . $arrAccessToken['access_token']);
        $authToken = $this->oauthProvider->authenticate(new OAuthToken());
        $this->tokenStorage->setToken($authToken);

        $this->fireOauthSuccessEvent($request);

        return $arrAccessToken;
    }
}
