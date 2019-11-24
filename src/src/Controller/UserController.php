<?php

namespace App\Controller;

use App\Entity\Tym;
use App\Entity\Uzivatel;
use App\Form\RegistrationFormType;
use App\Form\TymFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('user/base_user.html.twig', [
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
    public function newTym(Request $request)
    {
        $tym = new Tym();
        $form = $this->createForm(TymFormType::class, $tym);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            printf("ahoj");
            $tym->addUzivatele($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tym);
            $entityManager->flush();
        }

        return $this->render('user/novy_tym.html.twig', [
            'tymForm' => $form->createView()
        ]);
    }
}
