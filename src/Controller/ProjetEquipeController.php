<?php

namespace App\Controller;

use App\Entity\ProjetEquipe;
use App\Form\ProjetEquipeType;
use App\Repository\ProjetPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/projetEquipe/new", name="projetEquipe_new", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $projetEquipe = new ProjetEquipe();
        $form = $this->createForm(ProjetEquipeType::class, $projetEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projetEquipe);
            $entityManager->flush();

            return $this->redirectToRoute('admin_projetEquipe');
        }

        return $this->render('projetEquipe/new.html.twig', [
            'projetEquipe' => $projetEquipe,
            'form' => $form->createView(),
        ]);
    }
}
