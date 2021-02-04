<?php

namespace App\Controller;

use App\Repository\ProjetPersoRepository;
use App\Repository\ProjetEquipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * class AdminController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/projetPerso", name="projetPerso", methods={"GET"})
     * @param Request $request
     * @param ProjetPersoRepository $projetPersoRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function projetPersoShow(
        Request $request,
        ProjetPersoRepository $projetPersoRepository,
        PaginatorInterface $paginator
    ): Response {
        $donnes = $projetPersoRepository->findAll();
        $projetPersos = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('admin/projetPerso.html.twig', [
            'projetPersos' => $projetPersos
        ]);
    }

    /**
     * @Route("/projetEquipe", name="projetEquipe", methods={"GET"})
     * @param Request $request
     * @param ProjetEquipeRepository $projetEquipeRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function projetEquipeShow(
        Request $request,
        ProjetEquipeRepository $projetEquipeRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnes = $projetEquipeRepository->findAll();

        $projetEquipes = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/projetEquipe.html.twig', [
            'projetEquipes' => $projetEquipes
        ]);
    }
}
