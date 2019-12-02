<?php

namespace App\Controller;

use App\Entity\Tym;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TymController extends AbstractController
{
    /**
     * @Route("/tymy", name="app_tymy")
     */
    public function index(EntityManagerInterface $em,Request $request, PaginatorInterface $paginator)
    {
        $tymRepository = $em->getRepository(Tym::class);
        $tymy = $tymRepository->findAll();

        $pagination = $paginator->paginate(
            $tymy, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/
        );

        return $this->render('tym/tymy.html.twig', [
            'tymy' => $pagination
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
