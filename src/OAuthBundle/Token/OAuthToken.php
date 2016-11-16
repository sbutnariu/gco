<?php
/**
 * Created by PhpStorm.
 * User: f.pezier
 * Date: 26/05/14
 * Time: 18:06
 */

namespace OAuthBundle\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class OAuthToken extends AbstractToken
{
    const ANONYMOUS_SESSION = 'client';
    const USER_SESSION = 'user';
    const TECHNICAL_SESSION = 'technical';

    public $sessionId; // meetic ssid
    public $clientId; // Oauth client id

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }
}
