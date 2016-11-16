<?php

namespace OAuthBundle\Security\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ilius\Bundle\OAuthBundle\Security\User\OAuthUserProvider;
use OAuthBundle\Service\ResourceServer;
use OAuthBundle\Token\OAuthToken;

class OAuthProvider implements AuthenticationProviderInterface
{
    /**
     * @var ResourceServer
     */
    private $resourceServer;

    /**
     * @var OAuthUserProvider
     */
    private $userProvider;

    public function __construct(UserProviderInterface $userProvider, ResourceServer $resourceServer)
    {
        $this->resourceServer = $resourceServer;
        $this->userProvider = $userProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
        $this->resourceServer->initServer();
        $this->resourceServer->isValidToken();

        $user = $this->userProvider->loadUserByUsername($this->resourceServer->getOwnerId());

        if ($this->resourceServer->getOwnerType() === OAuthToken::TECHNICAL_SESSION) {
            $user->setRoles(array('ROLE_MEMBER_TECHNICAL'));
        }

        $authenticatedToken = new OAuthToken($user->getRoles());
        $authenticatedToken->sessionId = $this->resourceServer->getSessionId();
        $authenticatedToken->clientId = $this->resourceServer->getClientId();
        $authenticatedToken->setUser($user);

        return $authenticatedToken;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(TokenInterface $token)
    {
        return ($token instanceof OAuthToken);
    }
}
