<?php

namespace OAuthBundle\Services;


class AuthExecutor
{
    public function executeLdapLogin($username, $password)
    {
         if ($username == 'sbuntariu' && $password == 'parola') {
             return true;
         }
    }
}
