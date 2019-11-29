<?php

namespace App\Controller;

use App\Entity\Turnaj;
use App\Entity\Utkani;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtkaniController extends AbstractController
{
    /**
     * @Route("/utkani/generovani/{id_turnaj}", name="app_ generovani_utkani")
     */
    public function generovat_utkani($id_turnaj, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->find($id_turnaj);
        $pocet_tymu = $turnaj->getPocetTymu();
        $pocet_kol = floor(log($pocet_tymu,2));
        $tymy = $turnaj->getTymy();
        $pocet_zapasu_kola = $pocet_tymu/2;

        $cislo_utkani = 0;
        $help = 1;
        // vyplni prvni kolo
        foreach ($tymy as $tym)
        {
            if ($help % 2 == 1 )
            {
                $cislo_utkani++;
                $utkani = new Utkani();
                $utkani->setDomaci($tym)
                    ->setHoste($tymy->next())
                    ->setTurnaj($turnaj)
                    ->setKolo(1)
                    ->setCisloUtkani($cislo_utkani);
                $tymy->next();
                $em->persist($utkani);
            }
            $help++;
        }
        dump($cislo_utkani);
        // dlasi kola, vyplnit prazdne utkani
        for ($x = 2; $x <= $pocet_kol ; $x++)
        {
            $pocet_zapasu_kola /= 2;
            for ($j = 1; $j <= $pocet_zapasu_kola; $j++)
            {
                $cislo_utkani++;
                $utkani = new Utkani();
                $utkani->setTurnaj($turnaj)
                    ->setCisloUtkani($cislo_utkani)
                    ->setKolo($x);
                $em->persist($utkani);
            }
        }

        $em->flush();

        $this->addFlash('success', 'Utkání byly vygenerovány');

        return $this->redirectToRoute('app_turnaj', ['nazev' => $turnaj->getNazev()]);
    }
}
