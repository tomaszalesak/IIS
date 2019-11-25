<?php

namespace App\Controller;

use App\Entity\Tym;
use App\Entity\Uzivatel;
use App\Form\RegistrationFormType;
use App\Form\TymFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index()
    {
        return $this->render('main/main.html.twig', [
        ]);
    }

    /**
     * @Route("/user/tymy", name="app_user_tymy")
     */
    public function tymy()
    {
        /*** @var Uzivatel */
        $uzivatel = $this->getUser();
        return $this->render('user/tymy.html.twig', [
            'tymy' => $uzivatel->getTymy()
        ]);
    }

    /**
     * @Route("/user/novy_tym", name="app_user_novy_tym")
     */
    public function novyTym(Request $request)
    {
        $tym = new Tym();
        $form = $this->createForm(TymFormType::class, $tym);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tym->addUzivatele($this->getUser());
            $tym->setVedouci($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tym);
            $entityManager->flush();
            $this->addFlash('success', 'Tým byl vytvořen');
            return $this->redirectToRoute('app_user_tymy');
        }

        return $this->render('user/novy_tym.html.twig', [
            'tymForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/zmena_tymu/{nazev}", name="app_user_zmena_tym")
     */
    public function zmenaTym($nazev, Request $request, EntityManagerInterface $em)
    {
        $tym = $em->getRepository(Tym::class)->findOneBy(['jmeno' => $nazev]);

        $form = $this->createForm(TymFormType::class, $tym);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tym);
            $em->flush();
            $this->addFlash('success', 'Tým byl změněn');
            return $this->redirectToRoute('app_tym', ['nazev' => $tym->getJmeno()]);
        }

        return $this->render('user/zmena_tymu.html.twig', [
            'tymForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/odstranit_tymu/{id}", name="app_user_odstranit_tym")
     * @Method({"DELETE"})
     */
    public function odstranitTym($id, Request $request, EntityManagerInterface $em)
    {
        $tym = $em->getRepository(Tym::class)->find($id);
        $em->remove($tym);
        $em->flush();

        $this->addFlash('success', 'Tým byl odstraněn');

        return $this->redirectToRoute('app_user_tymy');
    }

    /**
     * @Route("/user/prihlasit_uzivatele_tym/{id}", name="app_user_prihlasit_tym")
     * @Method({"DELETE"})
     */
    public function prihlasitUzivateleDoTymu($id, Request $request, EntityManagerInterface $em)
    {
        $tym = $em->getRepository(Tym::class)->find($id);
        if($tym->getTyp()->getPocetClenuTymu() - $tym->getUzivatele()->count() != 0) {
            $tym->addUzivatele($this->getUser());
            $em->flush();
            $this->addFlash('success', 'Byl jsi přidán');

        }else
            $this->addFlash('err', 'Nelze, tým už je plný');
        return $this->redirectToRoute('app_tym', ['nazev' => $tym->getJmeno()]);
    }

}
