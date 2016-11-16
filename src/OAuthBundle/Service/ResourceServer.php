<?php

namespace OAuthBundle\Service;

use League\OAuth2\Server\Storage\SessionInterface;
use League\OAuth2\Server\Resource;
use League\OAuth2\Server\Exception\InvalidAccessTokenException;
use League\OAuth2\Server\Util\Request as OAuthRequest;
use Symfony\Component\HttpFoundation\RequestStack;


class ResourceServer extends Resource
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param SessionInterface $session
     * @param RequestStack $requestStack
     */
    public function __construct(SessionInterface $session, RequestStack $requestStack)
    {
        parent::__construct($session);

        $this->requestStack = $requestStack;

        $this->initServer();
    }

    /**
     * Initialise the Resource Server with a Guzzle client for WESA
     *
     * @return bool
     */
    public function initServer()
    {
        $request = $this->requestStack->getCurrentRequest();

        if (is_null($request)) {
            $oauthRequest = new OAuthRequest();
        } else {
            $oauthRequest = new OAuthRequest(
                $request->query->all(),
                $request->request->all(),
                $request->cookies->all(),
                $request->files->all(),
                $request->server->all(),
                $request->server->all()
            );
        }

        $this->setRequest($oauthRequest);
    }

    /**
     * @throws InvalidAccessTokenException
     */
    public function isValidToken()
    {
        $this->isValid(true);
    }

    public function deleteToken()
    {
        $this->isValidToken();
        return $this->storages['session']->deleteAccessToken($this->accessToken);
    }

    /**
     * Returns the computed session-ID
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}
