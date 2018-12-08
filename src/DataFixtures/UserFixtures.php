<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('user%d@test.com', $i));
            $user->setUsername(sprintf('user%d', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setIsEnabled(true);
            $user->setIsConfirmed(true);
            $user->setAgreedTermsAt(new \DateTime('now'));

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'Password1'
            ));

            return $user;
        });

        $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@test.com', $i));
            $user->setUsername(sprintf('admin%d', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setIsEnabled(true);
            $user->setIsConfirmed(true);
            $user->setAgreedTermsAt(new \DateTime('now'));

            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'Password1'
            ));

            return $user;
        });

        $manager->flush();
    }
}
