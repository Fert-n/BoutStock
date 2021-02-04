<?php

namespace App\DataFixtures;

use App\Entity\Bottle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BottleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->createBottle($manager,   'Jack Daniels',
                                        8,
                                        CategoryFixtures::ALCOOL_FORT,
                                        '2020',
                                        'bordeau',
                                        75);
        $this->createBottle($manager,   'vieille eglise',
                                        2,
                                        CategoryFixtures::VINS,
                                        '2018',
                                        'bordeau',
                                        75);
        $this->createBottle($manager, 'oasis',
                                        3,
                                        CategoryFixtures::SANS_ALCOOL,
                                        '2019',
                                        'france',
                                        150);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
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
        int $contenance
    ): void {
        $bottle = new Bottle();

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
