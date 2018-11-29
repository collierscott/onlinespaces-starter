<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('scollier');
        $user->setEmail('scott@onlinespaces.com');
        $user->setFirstName('Scott');
        $user->setLastName('Collier');
        $user->setIsConfirmed(true);
        $user->setIsEnabled(true);
        $user->setRoles(['ROLE_USER']);
        $user->agreeToTerms();

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'Password1'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
