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

        return $this->render('tym/index.html.twig', [
            'tymy' => $tymy
        ]);
    }
}
