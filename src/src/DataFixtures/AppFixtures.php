<?php

namespace App\DataFixtures;

use App\Entity\Turnaj;
use App\Entity\Typ;
use App\Entity\Tym;
use App\Entity\Uzivatel;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //Druh tymu / turnaje
        $typ3 = new Typ();
        $typ3->setNazev("3x3");
        $typ3->setPocetClenuTymu(5);

        $manager->persist($typ3);
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

        // Uzivatele
        $uzivatel1 = new Uzivatel();
        $uzivatel1->setUsername("uzivatel");
        $uzivatel1->setJmeno("Jan");
        $uzivatel1->setPrijmeni("Novák");
        $uzivatel1->setPassword($this->encoder->encodePassword($uzivatel1, 'heslo01'));
        $uzivatel1->setDatumNarozeni(new \DateTime());

        $manager->persist($uzivatel1);
        $manager->flush();


        $uzivatel = new Uzivatel();
        $uzivatel->setUsername("uzivatelka");
        $uzivatel->setJmeno("Jana");
        $uzivatel->setPrijmeni("Novákova");
        $uzivatel->setPassword($this->encoder->encodePassword($uzivatel, 'heslo01'));
        $uzivatel->setDatumNarozeni(new \DateTime());

        $manager->persist($uzivatel);
        $manager->flush();


        $tym= new Tym();
        $tym->setJmeno("TJ sokol Velka Bites");
        $tym->setAdresa("U Stadionu 548, Velká Bíteš");
        $tym->setPopis("Parta lidí z Velké Bíteše, Scházíme se každou neděli v sedm hodin v Sokolovně ve Velké Bíteši ");
        $tym->setVedouci($uzivatel);
        $tym->addUzivatele($uzivatel);
        $tym->setTyp($typ);

        $manager->persist($tym);
        $manager->flush();

        $uzivatel = new Uzivatel();
        $uzivatel->setUsername("jmeno");
        $uzivatel->setJmeno("Jana");
        $uzivatel->setPrijmeni("Dvořáková");
        $uzivatel->setPassword($this->encoder->encodePassword($uzivatel, 'heslo01'));
        $uzivatel->setDatumNarozeni(new \DateTime("1997-05-01"));

        $manager->persist($uzivatel);
        $manager->flush();

        $tym1= new Tym();
        $tym1->setJmeno("Basket Ruda");
        $tym1->setAdresa("Hospoda u Malců, Ruda 1");
        $tym1->setPopis("Parta lidí z Velké Bíteše, Scházíme se každou neděli v sedm hodin na Rudě");
        $tym1->setVedouci($uzivatel);
        $tym1->addUzivatele($uzivatel);
        $tym1->setTyp($typ);

        $manager->persist($tym1);
        $manager->flush();


        $turnaj = new Turnaj();
        $turnaj->setNazev("Turnaj na Rude");
        $turnaj->setAdresa("Hospoda u Malců, Ruda 1");
        $turnaj->setPopis("Dojdite si zahrat basket na rudu.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ);
        $turnaj->setDatum(new \DateTime());
        $turnaj->setMinimumTymu(2);
        $turnaj->setMaximumTymu(5);

        $turnaj->addTymy($tym);
        $turnaj->addTymy($tym1);

        $manager->persist($turnaj);
        $manager->flush();
        //$uzivatel->setDatumNarozeni("2014-01-02");
        //$uzivatel->setPassword("hashthisshit");
        //TODO: add hashed password
//        $uzivatel->setPassword(
//            $passwordEncoder->encodePassword(
//                $uzivatel,
//                $form->get('Password')->getData()
//            )
//        );


    }
}



