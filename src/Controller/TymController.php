<?php

namespace App\Controller;

use App\Entity\Tym;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TymController extends AbstractController
{
    /**
     * @Route("/tymy", name="app_tymy")
     */
    public function index(EntityManagerInterface $em)
    {
        $tymRepository = $em->getRepository(Tym::class);
        $tymy = $tymRepository->findAll();

        return $this->render('tym/tymy.html.twig', [
            'tymy' => $tymy
        ]);
    }

    /**
     * @Route("/tymy/show/{nazev}", name="app_tym")
     */
    public function detail($nazev, EntityManagerInterface $em)
    {
        $tym = $em->getRepository(Tym::class)->findOneBy(['jmeno' => $nazev]);

        if (!$tym) {
            throw $this->createNotFoundException(
                'Žádný tým nenalezen'.$nazev
            );
        }

        return $this->render('tym/tym_detail.html.twig', [
            'tym' => $tym
        ]);
    }
}
