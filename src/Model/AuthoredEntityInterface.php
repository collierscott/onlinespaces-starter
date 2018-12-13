<?php

namespace App\Model;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

interface AuthoredEntityInterface
{
    public function setAuthor(UserInterface $user): AuthoredEntityInterface;
    public function getAuthor(): ?User;
}