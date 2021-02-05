<?php

namespace App\DataFixtures;


use App\Entity\Cave;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public const CAVE = 'cave';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->createUser($manager, 'deschiens', 'deschiens@deschiens.fr', 'deschiens');
        $this->createUser($manager, 'chats', 'chats@chats.fr', 'chatons');
        $this->createUser($manager, 'humains', 'humains@humains.com', 'humains');

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
        $cave = new Cave();
        $user->setCave($cave);

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->encoder->encodePassword($user, $password));

        $this->addReference(self::CAVE.'_'.$username, $cave);

        $manager->persist($user);
    }

}
