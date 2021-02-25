<?php

namespace App\DataFixtures;


use App\Entity\Bottle;
use App\Entity\Cave;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public const USER = 'user';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('dfjshff');
        $user->setEmail('156@dgois.fr');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $manager->persist($user);

        $this->createUser($manager, 'deschiens', 'deschiens@deschiens.fr', 'deschiens');
        $this->createUser($manager, 'chats', 'chats@chats.fr', 'chatons');
        $this->createUser($manager, 'humains', 'humains@humains.com', 'humains');
        $this->createUser($manager, 'nath', 'nathanaelle.fert2020@campus-eni.fr', 'password');


        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function createUser(
        ObjectManager $manager,
        string $username,
        string $email,
        string $password

    ): void {
        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $this->addReference(self::USER.'_'.$username, $user);

        $manager->persist($user);
    }

}
