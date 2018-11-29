<?php

namespace App\Security;

use App\Entity\User;
use App\Exception\AccountDeletedException;
use App\Exception\AccountDisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * Checks the user account before authentication.
     *
     * @param UserInterface $user
     * @throws AccountDeletedException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if(!$user instanceof User) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        if ($user->getIsDeleted()) {
            throw new AccountDeletedException('Account Not Found.');
        }
    }

    /**
     * Checks the user account after authentication.
     *
     * @param UserInterface $user
     * @throws AccountDisabledException
     */
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->getIsEnabled()) {
            throw new AccountDisabledException();
        }
    }
}