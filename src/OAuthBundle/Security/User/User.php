<?php

namespace Ilius\Bundle\OAuthBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    protected $id;
    protected $username;
    protected $email;
    protected $agency;
    protected $roles;

    public function __construct($username)
    {
        $this->setRoles(array('ROLE_ANONYMOUS'));
        if (!empty($username)) {
            $this->$username = $username;
            $this->setRoles(array('ROLE_USER'));
        }
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set agency
     *
     * @param string $agency
     *
     * @return User
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;

        return $this;
    }

    /**
     * Get agency
     *
     * @return string
     */
    public function getAgency()
    {
        return $this->agency;
    }
    
    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }
}
