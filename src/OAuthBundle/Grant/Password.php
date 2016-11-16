<?php

namespace OAuthBundle\Grant;

use OAuthBundle\Service\AuthExecutor;
use League\OAuth2\Server\Authorization;
use League\OAuth2\Server\Exception\ClientException;
use League\OAuth2\Server\Exception\InvalidGrantTypeException;
use League\OAuth2\Server\Grant\Password as LeaguePassword;

class Password extends LeaguePassword
{
    /**
     * @var PasswordAuthExecutor
     */
    private $executor;

    /**
     * @param AuthExecutor $executor
     */
    public function setAuthExecutor(AuthExecutor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * Complete the password grant
     * @param null|array $inputParams
     * @return array
     * @throws ClientException
     * @throws InvalidGrantTypeException
     */
    public function completeFlow($inputParams = null)
    {
        $requiredParams = array('client_id', 'client_secret', 'username', 'password');

        // Get the required params
        $authParams = $this->authServer->getParam($requiredParams, 'post', $inputParams);

        foreach ($requiredParams as $param) {
            if (is_null($authParams[$param])) {
                throw new ClientException(sprintf(Authorization::getExceptionMessage('invalid_request'), $param), 0);
            }
        }

        // Validate client credentials
        $clientDetails = $this->authServer->getStorage('client')->getClient(
            $authParams['client_id'],
            $authParams['client_secret'],
            null,
            $this->identifier
        );

        if ($clientDetails === false) {
            throw new ClientException(Authorization::getExceptionMessage('invalid_client'), 8);
        }

        $loginResult = $this->executor->executeLdapLogin(
            $authParams['username'],
            $authParams['password']
        );

        // Generate an access token
        $accessToken = base64_encode($authParams['client_id'] . '-' . $loginResult->getSessionId());
        $accessTokenExpiresIn = ($this->accessTokenTTL !== null)
            ? $this->accessTokenTTL
            : $this->authServer->getAccessTokenTTL();

        // Create a new session
        $this->authServer->getStorage('session')->createMeeticSession(
            $authParams['client_id'],
            $loginResult->getType(),
            $loginResult->getAboId(),
            $loginResult->getSessionId(),
            $accessToken,
            $accessTokenExpiresIn
        );
        $sessionId = $this->authServer->getStorage('session')->createSession($authParams['client_id'], 'user', $authParams['username']);
        // Associate an access token with the session
        $accessTokenId = $this->authServer->getStorage('session')->associateAccessToken($sessionId, $accessToken, $accessTokenExpires);

        return array(
            'access_token' => $accessToken,
            'token_type' => 'bearer',
            'expires' => time() + $accessTokenExpiresIn,
            'expires_in' => $accessTokenExpiresIn,
            'enc' => $loginResult->getEnc()
        );
    }

    private function shouldAccountBeUnsuspended()
    {
        $forceParam = $this->authServer->getParam('force', 'post', array(), false);

        return filter_var($forceParam, FILTER_VALIDATE_BOOLEAN) == true;
    }
}
