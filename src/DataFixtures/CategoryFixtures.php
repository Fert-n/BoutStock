<?php

namespace App\DataFixtures;

use App\Entity\Bottle;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Type;

class CategoryFixtures extends Fixture
{
    public const ALCOOL_FORT = 'alcool_fort';
    public const SANS_ALCOOL = 'sans_alcool';
    public const VINS = 'vins';

    public function load(ObjectManager $manager)
    {
        $alcools = (new Category())->setType('Alcool fort');
        $sansAlcool = (new Category())->setType('Sans alcool');
        $vins = (new Category())->setType('Vins');

        $manager->persist($alcools);
        $manager->persist($sansAlcool);
        $manager->persist($vins);

        $this->addReference(self::ALCOOL_FORT, $alcools);
        $this->addReference(self::SANS_ALCOOL, $sansAlcool);
        $this->addReference(self::VINS, $vins);

        $manager->flush();
    }
}
