<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Form\EtudiantType;
use App\Repository\AdminRepository;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/etudiant")
 */
class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="etudiant_index", methods={"GET"})
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('etudiant/index.html.twig', ['etudiants' => $etudiantRepository->findAll(),]);
    }


// * @IsGranted("ROLE_USER") ==> tsedha fel annotation tethalek page login
    /**
     * @Route("/new", name="etudiant_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = new User();
            $user->setUsername($etudiant->getMail());
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    '123456'
                )
            );
            $user->setRoles(['ROLE_ETUDIANT']);
            $entityManager->persist($etudiant);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_index');
        }

        return $this->render('etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/view/{id}", name="etudiant_show", methods={"GET"})
     */
    public function show(Etudiant $etudiant): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('etudiant/show.html.twig', ['etudiant' => $etudiant,]);
    }

    /**
     * @Route("/{id}/edit", name="etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_index');
        }

        return $this->render('etudiant/edit.html.twig', ['etudiant' => $etudiant,'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etudiant_index');
    }

    /**
     * @Route("/document", name="admin_document", methods={"GET"})
     */
    public function Document(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/document.html.twig', ['admins' => $adminRepository->findAll(),]);
    }
}
