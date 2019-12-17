<?php

namespace App\Controller;

use App\Entity\MotCles;
use App\Form\MotClesType;
use App\Repository\MotClesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motCles")
 */
class MotClesController extends AbstractController
{
    /**
     * @Route("/", name="mot_cles_index", methods={"GET"})
     */
    public function index(MotClesRepository $motClesRepository): Response
    {
        return $this->render('mot_cles/index.html.twig', [
            'mot_cles' => $motClesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mot_cles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $motCle = new MotCles();
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motCle);
            $entityManager->flush();

            return $this->redirectToRoute('mot_cles_index');
        }

        return $this->render('mot_cles/new.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mot_cles_show", methods={"GET"})
     */
    public function show(MotCles $motCle): Response
    {
        return $this->render('mot_cles/show.html.twig', [
            'mot_cle' => $motCle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mot_cles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MotCles $motCle): Response
    {
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mot_cles_index');
        }

        return $this->render('mot_cles/edit.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mot_cles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MotCles $motCle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motCle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($motCle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mot_cles_index');
    }
}
