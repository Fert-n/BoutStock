<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Form\BottleType;
use App\Repository\BottleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bottle")
 */
class BottleController extends AbstractController
{
    /**
     * @Route("/", name="bottle_index", methods={"GET"})
     */
    public function index(BottleRepository $bottleRepository): Response
    {
        return $this->render('bottle/index.html.twig', [
            'bottles' => $bottleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bottle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bottle = new Bottle();
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bottle);
            $entityManager->flush();

            return $this->redirectToRoute('bottle_index');
        }

        return $this->render('bottle/new.html.twig', [
            'bottle' => $bottle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bottle_show", methods={"GET"})
     */
    public function show(Bottle $bottle): Response
    {
        return $this->render('bottle/show.html.twig', [
            'bottle' => $bottle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bottle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bottle $bottle): Response
    {
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bottle_index');
        }

        return $this->render('bottle/edit.html.twig', [
            'bottle' => $bottle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bottle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bottle $bottle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bottle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bottle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bottle_index');
    }

}
