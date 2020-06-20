<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Wallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $wallet = new Wallet();
        $wallet->setBalance(0);

        $user = new User();
        $user->setFullname('Admin admin');
        $user->setEmail('admin@mail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setDocumento('111222333');
        $user->setCelular('123123123');
        $user->setPassword( $this->encoder->encodePassword($user, 'password') );
        $user->setWallet($wallet);

        $manager->persist($user);
        $manager->flush();
    }
}
