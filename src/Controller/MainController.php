<?php

namespace App\Controller;


use App\Entity\Turnaj;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator)
    {
        $turnaje = $em->getRepository(Turnaj::class)->findAll();

        $pagination = $paginator->paginate(
            $turnaje, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('main/main.html.twig', [
            'turnaje' => $pagination
        ]);
    }
}
