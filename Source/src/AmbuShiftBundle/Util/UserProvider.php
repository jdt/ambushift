<?php
namespace AmbuShiftBundle\Util;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class UserProvider implements IUserProvider
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getCurrentUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}