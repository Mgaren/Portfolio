<?php

namespace App\Controller;

use App\Entity\ProjetPerso;
use App\Repository\ProjetPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetPersoController extends AbstractController
{
    /**
     * @Route("/projetPerso", name="projetPerso")
     */
    public function index(): Response
    {
        /** @var ProjetPersoRepository $repository */
        $this->getDoctrine()->getRepository(ProjetPerso::class);

        return $this->render('projetPerso/projetPerso.html.twig');
    }
}
