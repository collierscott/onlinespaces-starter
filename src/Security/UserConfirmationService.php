<?php

namespace App\Security;

use App\Exception\InvalidConfirmationTokenException;
use App\Helper\LoggerTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserConfirmationService
{
    use LoggerTrait;

    private $userRepository;

    private $manager;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $manager
    )
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
            $this->logger->debug('The confirmation token not found.', ['token_confirmation']);
            throw new InvalidConfirmationTokenException();
        }

        $user->setIsEnabled(true);
        $user->setConfirmationToken(null);
        $this->manager->flush();
    }
}