<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function (User $user, $i){
            $user->setFirstName($this->faker->firstname);
            $user->setEmail(strtolower($user->getFirstName().'@gmail.com'));
            $user->setPassword($this->passwordEncoder->encodePassword($user,'the_new_password'));
        });
        $manager->flush();
    }
}
