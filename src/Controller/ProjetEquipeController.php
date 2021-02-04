<?php

namespace App\Controller;

use App\Entity\ProjetEquipe;
use App\Repository\ProjetPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetEquipeController extends AbstractController
{
    /**
     * @Route("/projetEquipe", name="projetEquipe")
     */
    public function index(): Response
    {
        /** @var ProjetPersoRepository $repository */
        $this->getDoctrine()->getRepository(ProjetEquipe::class);

        return $this->render('projetEquipe/projetEquipe.html.twig');
    }
}
