<?php

namespace App\Controller;

use App\Entity\StatistikyHrace;
use App\Entity\Uzivatel;
use App\Form\ZmenaUzivateleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HracController extends AbstractController
{
    /**
     * @Route("/hraci", name="app_hraci")
     */
    public function hraci(EntityManagerInterface$em ,Request $request, PaginatorInterface $paginator)
    {
        $hraci = $em->getRepository(Uzivatel::class)->findAll();

        $pagination = $paginator->paginate(
            $hraci, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/
        );
        return $this->render('hrac/hraci.html.twig', [
            'hraci' => $pagination
        ]);
    }

    /**
     * @Route("/hrac/{id}", name="app_hrac")
     */
    public function hrac($id, EntityManagerInterface $em)
    {
        $hrac = $em->getRepository(Uzivatel::class)->find($id);
        $tymy = $hrac->getTymy();
        //$statistiky = $hrac->getStatistiky();
        $budouci_turnaje = [];
        $uplynule_turnaje = [];
        foreach ($tymy as $tym)
        {
            foreach ($tym->getTurnaje() as $turnaj)
            {
                if ($turnaj->getDatum() >= new \DateTime("now"))
                if ($turnaj->getDatum() >= new \DateTime("now"))
                    $budouci_turnaje[] = $turnaj;
                else
                    $uplynule_turnaje[] = $turnaj;
            }
        }
        $statistiky_soucet = $em->getRepository(StatistikyHrace::class)->soucetStatistik($hrac);
        $statistiky_prumer = $em->getRepository(StatistikyHrace::class)->prumerStatistik($hrac);

        return $this->render('hrac/hrac.html.twig', [
            'hrac' => $hrac,
            'budouci_turnaje' => $budouci_turnaje,
            'uplynule_turnaje' => $uplynule_turnaje,
            'statistiky_soucet' => $statistiky_soucet,
            'statistiky_prumer' => $statistiky_prumer
        ]);
    }

    /**
     * @Route("/user/zmena_hrac/{id}", name="app_user_zmena_hrac")
     * @IsGranted("ROLE_USER")
     */
    public function zmenaHrac($id, Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $hrac = $em->getRepository(Uzivatel::class)->find($id);

        $form = $this->createForm(ZmenaUzivateleFormType::class, $hrac);

        $form->get('jmeno')->setData($hrac->getJmeno());
        $form->get('prijmeni')->setData($hrac->getPrijmeni());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $hrac->setUsername($form->get('username')->getData());
            $hrac->setJmeno($form->get('jmeno')->getData());
            $hrac->setPrijmeni($form->get('prijmeni')->getData());

            $em->persist($hrac);
            $em->flush();
            $this->addFlash('success', 'Váš profil byl změněn');
            return $this->redirectToRoute('app_hrac', ['id' => $hrac->getId()]);
        }

        return $this->render('hrac/zmena_hrace.html.twig', [
            'uzivatelForm' => $form->createView()
        ]);
    }
}
