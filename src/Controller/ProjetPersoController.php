<?php

namespace App\Controller;

use App\Entity\ProjetPerso;
use App\Form\ProjetPersoType;
use App\Repository\ProjetPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProjetPersoController extends AbstractController
{
    /**
     * @Route("/projetPerso", name="projetPerso")
     * @param ProjetPersoRepository $persoRepository
     * @return Response
     */
    public function index(ProjetPersoRepository $persoRepository): Response
    {
        return $this->render('projetPerso/projetPerso.html.twig', [
            'projetPersos' => $persoRepository->findAll()
        ]);
    }

    /**
     * @Route("/projetPerso/new", name="projetPerso_new", methods={"GET", "POST"})
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return Response
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $projetPerso = new ProjetPerso();
        $form = $this->createForm(ProjetPersoType::class, $projetPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $imageFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageFilename = $slugger->slug($imageFilename);
                $newImageFile = $safeImageFilename . '-' . uniqid('', true) . '-' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('upload_dir'),
                        $newImageFile
                    );
                } catch (FileException $e) {
                }
                $projetPerso->setImage($newImageFile);
            }
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
