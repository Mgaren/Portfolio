<?php

namespace App\Controller;

use App\Entity\ProjetPerso;
use App\Form\ProjetPersoType;
use App\Repository\ProjetPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/projetPerso/new", name="projetPerso_new", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $projetPerso = new ProjetPerso();
        $form = $this->createForm(ProjetPersoType::class, $projetPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projetPerso);
            $entityManager->flush();

            return $this->redirectToRoute('admin_projetPerso');
        }

        return $this->render('projetPerso/new.html.twig', [
            'projetPerso' => $projetPerso,
            'form' => $form->createView(),
        ]);
    }
}
