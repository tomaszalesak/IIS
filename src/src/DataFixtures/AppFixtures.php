<?php

namespace App\DataFixtures;

use App\Entity\Typ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $typ = new Typ();
        $typ->setNazev("3x3");
        $typ->setPocetClenuTymu(5);

        $manager->persist($typ);
        $manager->flush();

        $typ = new Typ();
        $typ->setNazev("5x5");
        $typ->setPocetClenuTymu(12);

        $manager->persist($typ);
        $manager->flush();

        $typ = new Typ();
        $typ->setNazev("1x1");
        $typ->setPocetClenuTymu(1);

        $manager->persist($typ);
        $manager->flush();
    }
}
