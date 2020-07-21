<?php

namespace App\Controller;

use App\Repository\SoutenanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Soutenance;
use App\Form\SoutenanceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/soutenance")
 */
class SoutenanceController extends AbstractController
{
    /**
     * @Route("/", name="soutenance_index", methods={"GET"})
     */
    public function index(SoutenanceRepository $soutenanceRepository): Response
    {
        return $this->render('soutenance/index.html.twig', ['soutenances' => $soutenanceRepository->findAll(),]);
    }

    /**
     * @Route("/dateS", name="soutenance_date", methods={"GET"})
     */
    public function Document(SoutenanceRepository $soutenanceRepository): Response
    {
        return $this->render('soutenance/home.html.twig', ['soutenances' => $soutenanceRepository->findAll(),]);
    }

    /**
     * @Route("/new", name="soutenance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $soutenance = new Soutenance();
        $form = $this->createForm(SoutenanceType::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soutenance);
            $entityManager->flush();

            return $this->redirectToRoute('soutenance_index');
        }

        return $this->render('soutenance/new.html.twig', [
            'soutenance' => $soutenance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soutenance_show", methods={"GET"})
     */
    public function show(Soutenance $soutenance): Response
    {
        return $this->render('soutenance/show.html.twig', [
            'soutenance' => $soutenance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="soutenance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Soutenance $soutenance): Response
    {
        $form = $this->createForm(SoutenanceType::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soutenance_index');
        }

        return $this->render('soutenance/edit.html.twig', [
            'soutenance' => $soutenance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soutenance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Soutenance $soutenance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soutenance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soutenance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('soutenance_index');
    }
}
