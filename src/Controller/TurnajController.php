<?php

namespace App\Controller;

use App\Entity\Turnaj;
use App\Entity\Tym;
use App\Entity\Uzivatel;
use App\Form\TurnajFormType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TurnajController extends AbstractController
{
    /**
     * @Route("/turnaje", name="app_turnaje")
     */
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator)
    {
        $turnaje = $em->getRepository(Turnaj::class)->findAll();

        $pagination = $paginator->paginate(
            $turnaje, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('turnaj/turnaje.html.twig', [
            'turnaje' => $pagination
        ]);
    }

    /**
     * @Route("/user/turnaje", name="app_user_turnaje")
     */
    public function user_turnaje()
    {
        $uzivatel = $this->getUser();
        return $this->render('turnaj/user_turnaje.html.twig', [
            'turnaje' => $uzivatel->getVedouciTurnaje()
        ]);
    }

    /**
     * @Route("/user/novy_turnaj", name="app_user_novy_turnaj")
     * @IsGranted("ROLE_USER")
     */
    public function novyTurnaj(Request $request)
    {
        $turnaj = new Turnaj();
        $form = $this->createForm(TurnajFormType::class, $turnaj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $turnaj->setVedouci($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($turnaj);
            $entityManager->flush();
            $this->addFlash('success', 'Turnaj byl vytvořen');
            return $this->redirectToRoute('app_user_turnaje');
        }

        return $this->render('turnaj/novy_turnaj.html.twig', [
            'turnajForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/zmena_turnaje/{nazev}", name="app_user_zmena_turnaj")
     * @IsGranted("ROLE_USER")
     */
    public function zmenaTurnaj($nazev, Request $request, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->findOneBy(['nazev' => $nazev]);

        $form = $this->createForm(TurnajFormType::class, $turnaj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($turnaj);
            $em->flush();
            $this->addFlash('success', 'Turnaj byl změněn');
            return $this->redirectToRoute('app_turnaj', ['nazev' => $turnaj->getNazev()]);
        }

        return $this->render('turnaj/zmena_turnaje.html.twig', [
            'turnajForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/turnaje/show/{nazev}", name="app_turnaj")
     */
    public function detail($nazev, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->findOneBy(['nazev' => $nazev]);

        if (!$turnaj) {
            throw $this->createNotFoundException(
                'Žádný turnaj nenalezen'.$nazev
            );
        }

        $pocet_kol = floor(log($turnaj->getPocetTymu(),2));

        return $this->render('turnaj/turnaj_detail.html.twig', [
            'turnaj' => $turnaj,
            'pocet_kol' => $pocet_kol
        ]);
    }

    /**
     * @Route("/user/odstranit_turnaj/{id}", name="app_user_odstranit_turnaj")
     * @Method({"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function odstranitTurnaj($id, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->find($id);
        $em->remove($turnaj);
        $em->flush();

        $this->addFlash('success', 'Turnaj byl odstraněn');

        return $this->redirectToRoute('app_user_turnaje');
    }

    /**
 * @Route("/user/prihlasit_tym_turnaj/{turnaj_id}/{tym_id}", name="app_user_prihlasit_tym_turnaj")
 * @Method({"DELETE"})
 * @IsGranted("ROLE_USER")
 */
    public function prihlasitTymDoTurnaje($turnaj_id, $tym_id, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->find($turnaj_id);
        $tym = $em->getRepository(Tym::class)->find($tym_id);
        $rozhodci = $turnaj->getRozhodci();
        $tymy_turnaje = $turnaj->getTymy();
        $err = 0;

        if ($tym->getUzivatele()->count() < $turnaj->getTyp()->getMinPocetClenu())
            $err = 1;

        foreach ($tymy_turnaje as $tym_t)
        {
            $clenove_tymu_turnaje = $tym_t->getUzivatele();
            foreach ($clenove_tymu_turnaje as $clen)
            {
                if($tym->getUzivatele()->contains($clen)) {
                    $err = 2;
                    break;
                }
            }
        }

        foreach($rozhodci as $roz )
        {
            if($tym->getUzivatele()->contains($roz)) {
                $err = 3;
                break;
            }
        }

        $err_text = 'Nelze přidat tento tým';
        if ($err == 1)
            $err_text = 'Nelze přidat tento tým, tým neobsahuje minimalní počet hráčů';
        else if ($err == 2)
            $err_text = 'Nelze přidat tento tým, protože nějaký člen týmu je členem už přihlášeného týmu';
        else if ($err == 3)
            $err_text = 'Nelze přidat tento tým, protože nějaký člen týmu je rozhodčí tohoto turnaje';

        if(($turnaj->getTyp() == $tym->getTyp()) and $this->getUser() == $tym->getVedouci() and $err == 0){
            $turnaj->addTymy($tym);
            $em->persist($turnaj);
            $em->flush();
            $this->addFlash('success', 'Tým byl přidán');
        }else
            $this->addFlash('err', $err_text);



        return $this->redirectToRoute('app_turnaj', ['nazev' => $turnaj->getNazev()]);
    }

    /**
     * @Route("/user/prihlasit_rozhodci_turnaj/{turnaj_id}", name="app_user_prihlasit_rozhodci_turnaj")
     * @IsGranted("ROLE_USER")
     */
    public function prihlasitRozhodcihoDoTurnaje($turnaj_id, EntityManagerInterface $em)
    {
        $turnaj = $em->getRepository(Turnaj::class)->find($turnaj_id);
        $tymy = $turnaj->getTymy();
        $err = 0;

        foreach($tymy  as $tym){
            if($tym->getUzivatele()->contains($this->getUser())) {
                $err = 1;
                break;
            }
        }
        if($err == 1)
            $this->addFlash('err', 'Nemůžeš se zapsat jako rozhodčí pokud, jsi v nějakém týmu na turnaji');
        else{
            $turnaj->addRozhodci($this->getUser());
            $em->persist($turnaj);
            $em->flush();
            $this->addFlash('success', 'Byl jsi přidán jako rozhodčí');
        }

        return $this->redirectToRoute('app_turnaj', ['nazev' => $turnaj->getNazev()]);
    }
}
