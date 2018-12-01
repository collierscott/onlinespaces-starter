<?php

namespace App\Security;

use App\Exception\InvalidConfirmationTokenException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class UserConfirmationService
{
    private $userRepository;

    private $manager;

    private $logger;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $manager,
        LoggerInterface $logger
    )
    {
        $this->userRepository = $userRepository;
        $this->manager = $manager;
        $this->logger = $logger;
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
            $this->logger->debug('The confirmation token not found.');
            throw new InvalidConfirmationTokenException();
        }

        $user->setIsEnabled(true);
        $user->setConfirmationToken(null);
        $this->manager->flush();
    }
}