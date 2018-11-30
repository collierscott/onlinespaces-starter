<?php

namespace App\Security;

use App\Exception\InvalidConfirmationTokenException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserConfirmationService
{
    private $userRepository;

    private $manager;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $manager)
    {
        $this->userRepository = $userRepository;
        $this->manager = $manager;
    }

    /**
     * @param string $token
     * @throws InvalidConfirmationTokenException
     */
    public function confirmUser(string $token)
    {
        $user = $this->userRepository->findOneBy(
            ['confirmationToken' => $token]
        );

        if(!$user) {
            throw new InvalidConfirmationTokenException();
        }

        $user->setIsEnabled(true);
        $user->setConfirmationToken(null);
        $this->manager->flush();
    }
}