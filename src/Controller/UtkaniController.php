<?php

namespace App\Controller;

use App\Entity\Turnaj;
use App\Entity\Utkani;
use App\Form\UtkaniFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtkaniController extends AbstractController
{
    /**
     * @Route("/utkani/generovani/{id_turnaj}", name="app_ generovani_utkani")
     * @IsGranted("ROLE_USER")
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
        // dlasi kola, vyplnit prazdne utkani
        for ($x = 2; $x <= $pocet_kol ; $x++)
        {
            $cislo_utkani = 0;
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


    /**
     * @Route("/utkani/statistiky/{id}", name="app_ statistiky_utkani")
     * @IsGranted("ROLE_USER")
     */
    public function statistiky_utkani($id,Request $request, EntityManagerInterface $em)
    {
        $utkani = $em->getRepository(Utkani::class)->find($id);
        $turnaj = $utkani->getTurnaj();

        $form = $this->createForm(UtkaniFormType::class, $utkani);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('domaci_body')->getData() > $form->get('hoste_body')->getData())
            {
                $utkani->getHoste()->removeVyherniUtkani($utkani);
                $utkani->setVyherce($utkani->getDomaci());
            }
            else
            {
                $utkani->getDomaci()->removeVyherniUtkani($utkani);
                $utkani->setVyherce($utkani->getHoste());

            }

            $em->persist($utkani);

            //pokud to neni posledni kolo tak vyherce poslu do dalsiho kola
            if (floor(log($turnaj->getPocetTymu(),2)) != $utkani->getKolo())
            {
                $cislo_dalsiho_utkani = intdiv($utkani->getCisloUtkani() + 1, 2);
                $help = ($utkani->getCisloUtkani() + 1) % 2;
                $postupujici_utkani = $em->getRepository(Utkani::class)->findOneBy(['kolo'=> $utkani->getKolo()+1, 'cislo_utkani'=> $cislo_dalsiho_utkani, 'turnaj' => $turnaj]);
                if($help == 0)
                    $postupujici_utkani->setDomaci($utkani->getVyherce());
                else
                    $postupujici_utkani->setHoste($utkani->getVyherce());
                $em->persist( $postupujici_utkani);
            }

            $em->flush();

            $this->addFlash('success', 'Statiky utkání byly zapsány');
            return $this->redirectToRoute('app_turnaj', ['nazev' => $utkani->getTurnaj()->getNazev()]);
        }

        return $this->render('utkani/statistiky.html.twig', [
            'utkaniForm' => $form->createView(),
            'utkani' => $utkani
        ]);
    }
}
