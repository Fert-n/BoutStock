<?php

namespace App\DataFixtures;

use App\Entity\Bottle;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BottleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->createBottle($manager,
            'Jack Daniels',
            8,
            CategoryFixtures::ALCOOL_FORT,
            '2020',
            'bordeau',
            75,
            UserFixtures::USER.'_deschiens'
        );

        $this->createBottle($manager, 'vieille eglise',
            2,
            CategoryFixtures::VINS,
            '2018',
            'bordeau',
            75,
            UserFixtures::USER.'_chats'
        );

        $this->createBottle($manager, 'oasis',
            3,
            CategoryFixtures::SANS_ALCOOL,
            '2019',
            'france',
            150,
            UserFixtures::USER.'_humains');

        $this->createBottle($manager, 'oasis',
            3,
            CategoryFixtures::SANS_ALCOOL,
            '2019',
            'france',
            150,
            UserFixtures::USER.'_nath');

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CategoryFixtures::class,
        );
    }

    /**
     * @param ObjectManager $manager
     */
    public function createBottle(
        ObjectManager $manager,
        string $name,
        int $quantity,
        string $category,
        string $miseBout,
        string $region,
        int $contenance,
        string $user
    ): void
    {
        $bottle = new Bottle();

        $bottle->setCave($this->getReference($user)->getCave());
        $bottle->setName($name);
        $bottle->setQuantity($quantity);
        $bottle->setType($this->getReference($category));
        $bottle->setMisebout(\DateTime::createFromFormat('Y', $miseBout));
        $bottle->setCreateAt(new \DateTime());
        $bottle->setRegion($region);
        $bottle->setContenance($contenance);

        $manager->persist($bottle);
    }
}
