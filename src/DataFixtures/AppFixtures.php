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

        $typ5 = new Typ();
        $typ5->setNazev("5x5");
        $typ5->setPocetClenuTymu(12);

        $manager->persist($typ5);
        $manager->flush();

        $typ = new Typ();
        $typ->setNazev("1x1");
        $typ->setPocetClenuTymu(1);

        $typ1 = $typ;

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

        $franta = new Uzivatel();
        $franta->setUsername("franta");
        $franta->setJmeno("František");
        $franta->setPrijmeni("Horký");
        $franta->setPassword($this->encoder->encodePassword($franta, 'heslo01'));
        $franta->setDatumNarozeni(new \DateTime("1998-04-09"));

        $manager->persist($franta);
        $manager->flush();

        $pepa = new Uzivatel();
        $pepa->setUsername("pepa");
        $pepa->setJmeno("Josef");
        $pepa->setPrijmeni("Svoboda");
        $pepa->setPassword($this->encoder->encodePassword($pepa, 'heslo01'));
        $pepa->setDatumNarozeni(new \DateTime("1996-10-06"));

        $manager->persist($pepa);
        $manager->flush();

        $rozhodci = new Uzivatel();
        $rozhodci->setUsername("rozhodci");
        $rozhodci->setJmeno("Marek");
        $rozhodci->setPrijmeni("Briza");
        $rozhodci->setPassword($this->encoder->encodePassword($rozhodci, 'heslo01'));
        $rozhodci->setDatumNarozeni(new \DateTime("1980-09-12"));
        $rozhodci->setJeRozhodci(1);

        $manager->persist($rozhodci);
        $manager->flush();

        $slavek = new Uzivatel();
        $slavek->setUsername("slavek");
        $slavek->setJmeno("Jaroslav");
        $slavek->setPrijmeni("Novotný");
        $slavek->setPassword($this->encoder->encodePassword($slavek, 'heslo01'));
        $slavek->setDatumNarozeni(new \DateTime("1986-10-06"));
        $slavek->setJeRozhodci(1);

        $manager->persist($slavek);
        $manager->flush();

        $petr = new Uzivatel();
        $petr->setUsername("petr");
        $petr->setJmeno("Petr");
        $petr->setPrijmeni("Horák");
        $petr->setPassword($this->encoder->encodePassword($petr, 'heslo01'));
        $petr->setDatumNarozeni(new \DateTime("1974-8-20"));

        $manager->persist($petr);
        $manager->flush();

        $marie = new Uzivatel();
        $marie->setUsername("marie");
        $marie->setJmeno("Marie");
        $marie->setPrijmeni("Černá");
        $marie->setPassword($this->encoder->encodePassword($marie, 'heslo01'));
        $marie->setDatumNarozeni(new \DateTime("1998-8-20"));

        $manager->persist($marie);
        $manager->flush();



        $uzivatel = new Uzivatel();
        $uzivatel->setUsername("uzivatelka");
        $uzivatel->setJmeno("Jana");
        $uzivatel->setPrijmeni("Novákova");
        $uzivatel->setPassword($this->encoder->encodePassword($uzivatel, 'heslo01'));
        $uzivatel->setDatumNarozeni(new \DateTime("1991-06-07"));
        $uzivatel->setJeRozhodci(null);

        $manager->persist($uzivatel);
        $manager->flush();


        $tym= new Tym();
        $tym->setJmeno("TJ sokol Velka Bites");
        $tym->setAdresa("U Stadionu 548, Velká Bíteš");
        $tym->setPopis("Parta lidí z Velké Bíteše, Scházíme se každou neděli v sedm hodin v Sokolovně ve Velké Bíteši ");
        $tym->setVedouci($uzivatel);
        $tym->addUzivatele($uzivatel);
        $tym->setTyp($typ1);

        $manager->persist($tym);
        $manager->flush();

        $uzivatel = new Uzivatel();
        $uzivatel->setUsername("dvorakova");
        $uzivatel->setJmeno("Jana");
        $uzivatel->setPrijmeni("Dvořáková");
        $uzivatel->setPassword($this->encoder->encodePassword($uzivatel, 'heslo01'));
        $uzivatel->setDatumNarozeni(new \DateTime("1997-05-01"));

        $manager->persist($uzivatel);
        $manager->flush();

        $jiri = new Uzivatel();
        $jiri->setUsername("jiri");
        $jiri->setJmeno("Jiří");
        $jiri->setPrijmeni("Marek");
        $jiri->setPassword($this->encoder->encodePassword($jiri, 'heslo01'));
        $jiri->setDatumNarozeni(new \DateTime("1990-8-20"));

        $manager->persist($jiri);
        $manager->flush();

        $eva = new Uzivatel();
        $eva->setUsername("eva");
        $eva->setJmeno("Eva");
        $eva->setPrijmeni("Marková");
        $eva->setPassword($this->encoder->encodePassword($eva, 'heslo01'));
        $eva->setDatumNarozeni(new \DateTime("1991-06-02"));

        $manager->persist($eva);
        $manager->flush();

        $lucie = new Uzivatel();
        $lucie->setUsername("lucie");
        $lucie->setJmeno("Lucie");
        $lucie->setPrijmeni("Pospíšilová");
        $lucie->setPassword($this->encoder->encodePassword($lucie, 'heslo01'));
        $lucie->setDatumNarozeni(new \DateTime("1997-06-02"));

        $manager->persist($lucie);
        $manager->flush();

        $hana = new Uzivatel();
        $hana->setUsername("hana");
        $hana->setJmeno("Hana");
        $hana->setPrijmeni("Procházková");
        $hana->setPassword($this->encoder->encodePassword($hana, 'heslo01'));
        $hana->setDatumNarozeni(new \DateTime("1995-06-10"));

        $manager->persist($hana);
        $manager->flush();



        //VB b
        $tomas = new Uzivatel();
        $tomas->setUsername("tomas");
        $tomas->setJmeno("Tomáš");
        $tomas->setPrijmeni("Pokorný");
        $tomas->setPassword($this->encoder->encodePassword($tomas, 'heslo01'));
        $tomas->setDatumNarozeni(new \DateTime("2000-11-11"));

        $manager->persist($tomas);
        $manager->flush();

        $vaclav = new Uzivatel();
        $vaclav->setUsername("vaclav");
        $vaclav->setJmeno("Václav");
        $vaclav->setPrijmeni("Krejčí");
        $vaclav->setPassword($this->encoder->encodePassword($vaclav, 'heslo01'));
        $vaclav->setDatumNarozeni(new \DateTime("1957-08-21"));

        $manager->persist($vaclav);
        $manager->flush();

        $mirek = new Uzivatel();
        $mirek->setUsername("mirek");
        $mirek->setJmeno("Miroslav");
        $mirek->setPrijmeni("Němec");
        $mirek->setPassword($this->encoder->encodePassword($mirek, 'heslo01'));
        $mirek->setDatumNarozeni(new \DateTime("1987-09-27"));

        $manager->persist($mirek);
        $manager->flush();



//Tymy
        //1v1
        $users = array($uzivatel, $uzivatel1, $franta, $pepa, $petr);
        $addresses = array("Ruda 30","Lánice 51, Velká Bíteš", "Březí 12", "Křoví 3", "Jabloňnov 24");
        $userTeams = array();

        $i=0;
        foreach ($users as $user) {
            $tym1 = new Tym();
            $jmeno = $user->getJmeno()." ".$user->getPrijmeni();
            $tym1->setJmeno($jmeno);

            $tym1->setAdresa($addresses[$i]);

            $tym1->setPopis("");
            $tym1->setVedouci($user);
            $tym1->addUzivatele($user);
            $tym1->setTyp($typ);

            $manager->persist($tym1);
            $manager->flush();

            $userTeams[$i] = $tym1;
            $i= $i+1;
        }


        //3v3
        $jablonov= new Tym();
        $jablonov->setJmeno("TJ Druzstevnik Jablonov");
        $jablonov->setAdresa("Hospoda U Šídlů, Jablonov 1");
        $jablonov->setPopis("Tělovýchovná jednota TJ Družstevník Jabloňov byla založena již roku 1958 v obci Jabloňov. Klubovna se nachází v místní Hospodě U Šídlů a v současné době sdružuje lidi z vesnice i jejího okolí, kteří mají pozitivní vztah ke sportu.");
        //here
        $jablonov->setVedouci($uzivatel);
        $jablonov->addUzivatele($uzivatel);
        $jablonov->addUzivatele($jiri);
        $jablonov->addUzivatele($marie);
        $jablonov->addUzivatele($petr);
        $jablonov->setTyp($typ3);

        $manager->persist($jablonov);
        $manager->flush();


        $hermanice= new Tym();
        $hermanice->setJmeno("SK Dolni Hermanice");
        $hermanice->setAdresa("Obecni urad Dolni Hermanice, Dolni Hermanice 6");
        $hermanice->setPopis("Původně fotbalový klub, který sídlí v Dolních Heřmanicích. Byl založen roku 1993 a v současné době se věnuje zejména výchovou mládeže napříč různými sportovními odvětvími.");
        //here
        $hermanice->setVedouci($uzivatel1);
        $hermanice->addUzivatele($uzivatel);
        $hermanice->addUzivatele($uzivatel1);
        $hermanice->addUzivatele($franta);

        $hermanice->setTyp($typ3);

        $manager->persist($hermanice);
        $manager->flush();


        $bitesA= new Tym();
        $bitesA->setJmeno("BK Velká Bíteš \"A\"");
        $bitesA->setAdresa("Druztevni 69 Velká Bíteš");
        $bitesA->setPopis("Basketbalový klub BK Velká Bíteš má již velice dlouhou historii. Byl založen v roce 1920 a ...  .. V dobách svojí největší slávy se tým účastnil soutěže... ");
        //here
        $bitesA->setVedouci($pepa);
        $bitesA->addUzivatele($pepa);
        $bitesA->addUzivatele($lucie);
        $bitesA->addUzivatele($hana);
        $bitesA->setTyp($typ3);

        $manager->persist($bitesA);
        $manager->flush();

        $bitesB= new Tym();
        $bitesB->setJmeno("BK Velká Bíteš \"B\"");
        $bitesB->setAdresa("Druztevni 69 Velká Bíteš");
        $bitesB->setPopis("Záloha Velké Bíteše byla založena toku 1995.");
        //here
        $bitesB->setVedouci($tomas);
        $bitesB->addUzivatele($tomas);
        $bitesB->addUzivatele($vaclav);
        $bitesB->addUzivatele($mirek);
        $bitesB->setTyp($typ3);

        $manager->persist($bitesB);
        $manager->flush();


        //TURNAJE
        $turnaj = new Turnaj();
        $turnaj->setNazev("Turnaj na Rude");
        $turnaj->setAdresa("Hospoda u Malců, Ruda 1");
        $turnaj->setPopis("Dojdite si zahrat basket na rudu.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ1);
        $turnaj->setDatum(new \DateTime());
        $turnaj->setpocetTymu(4);

        $turnaj->addTymy($tym);
        $turnaj->addTymy($tym1);

        $manager->persist($turnaj);
        $manager->flush();


        $turnaj = new Turnaj();
        $turnaj->setNazev("Memorial Františka Palackého");
        $turnaj->setAdresa("U stadionu 4, Polná");
        $turnaj->setPopis("Zveme vás na 12. ročník již tradiční ho turneje v Basketballu, který se uskuteční 1.4.2020 v Polné na hřišti. Jedná se o Vyřazovací  soutěž pro 8 tříčlenných týmů. Startovné pro každý tým je 200 Kč a zahrnuje poukaz na Steak a Pivo-Limo pro každého člena týmu.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ3);
        $turnaj->setDatum(new \DateTime("2020-04-01"));

        $turnaj->setpocetTymu(4);

        $turnaj->addTymy($jablonov);
        $turnaj->addTymy($hermanice);

        $manager->persist($turnaj);
        $manager->flush();

        $turnaj = new Turnaj();
        $turnaj->setNazev("3v3 na Rudě");
        $turnaj->setAdresa("Malé hřiště, Ruda");
        $turnaj->setPopis("Zveme vás na první ročník Basketbalového turnaje pro tří až pětičlenné týmy !! který se uskuteční 1.9.2019 v Rudě u Velkého Meziříčí. Zahájení se koná ve 14 hodin na malém hřišti. Herní systém 3v3. K poslechu a tanci zahraje skupina Galáni.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ3);
        $turnaj->setDatum(new \DateTime("2019-09-01"));
        $turnaj->setpocetTymu(4);

        $turnaj->addTymy($bitesB);
        //TODO: pridat tymy
        $manager->persist($turnaj);
        $manager->flush();

        $turnaj = new Turnaj();
        $turnaj->setNazev("Děravý koš");
        $turnaj->setAdresa("Sportovní Hala, Osová Bitýška");
        $turnaj->setPopis("Zveme vás na turnaj děravý koš pro jednotlivce, který se uskuteční 1. 6. 2019 v rámci sportovního dne v Osové Bitýšce. Registrace proběhne ve 13. hodin ve sportovní hale Základní Školy.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ1);
        $turnaj->addRozhodci($slavek);
        $turnaj->addRozhodci($rozhodci);
        $turnaj->setDatum(new \DateTime("2019-06-01"));
        $turnaj->setpocetTymu(4);

        for ($x = 0; $x < 4; $x++) {
            $turnaj->addTymy($userTeams[$x]);
        }

        $manager->persist($turnaj);
        $manager->flush();

        //5v5
        $turnaj = new Turnaj();
        $turnaj->setNazev("Turnaj o město Tišnov");
        $turnaj->setAdresa("Tišnov, Sokolovna");
        $turnaj->setPopis("Zveme vas na Turnaj o město Tišnov, který se uskuteční 1. 12. 2019 v Tišnovské sokolovně. Slavnostní zahájení je v 15.00. K poslechu a tanci zahraje skupina Accort. Připravena zábava i pro celou rodinu.");
        $turnaj->setVedouci($slavek);
        $turnaj->setTyp($typ3);
        $turnaj->setDatum(new \DateTime("2020-10-23"));
        $turnaj->setpocetTymu(4);
        //TODO: pridat tymy
        $manager->persist($turnaj);
        $manager->flush();

        $turnaj = new Turnaj();
        $turnaj->setNazev("Slivovica Cup");
        $turnaj->setAdresa("Jabloňov, hřiště");
        $turnaj->setPopis("Zveme Vás na tradiční Slivovica cup, který se uskuteční 13.3.2019 na hřišti v obci Jabloňov. Jedná se o turnaj pro 4 týmy systémem 5v5, přičemž vítěz obdrží 1 litr kvalitní slivovice z místní pěstitelské pálenice.");
        $turnaj->setVedouci($uzivatel);
        $turnaj->setTyp($typ5);
        $turnaj->setDatum(new \DateTime("2020-03-22"));
        $turnaj->setpocetTymu(4);
        //TODO: pridat tymy
        $manager->persist($turnaj);
        $manager->flush();



    }
}



