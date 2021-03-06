<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Repository\AdminRepository;
use App\Repository\RapportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/index.html.twig', ['admins' => $adminRepository->findAll(),]);
    }

    /**
     * @Route("/listRapport", name="list_rapport", methods={"GET"})
     */
    public function listRapport(RapportRepository $rapportRepository): Response
    {
        return $this->render('admin/listRapport.html.twig', ['rapports' => $rapportRepository->findAll(),]);
    }
    /**
     * @Route("/document", name="admin_document", methods={"GET"})
     */
    public function Document(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/document.html.twig', ['admins' => $adminRepository->findAll(),]);
    }

    /**
     * @Route("/dossier", name="admin_pdf", methods={"GET"})
     */
    public function MyPdf(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/mypdf.html.twig', ['admins' => $adminRepository->findAll(),]);
    }


    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request , \Swift_Mailer $mailer): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file = $admin->getDocument();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),$fileName);
            $admin->setDocument($fileName);
            $entityManager->persist($admin);

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('recipient@example.com')
                ->setBody(
                    $this->renderView(
                    // templates/hello/email.txt.twig
                        'mail/email.txt.twig',
                        ['name' => $admin->getDocument()]
                    )
                )
            ;
            $mailer->send($message);

            $entityManager->flush();

            return $this->redirectToRoute('admin_pdf');
        }

        return $this->render('admin/new.html.twig', ['admin' => $admin,'form' => $form->createView(),]);
    }

    /**
     * @Route("/{id}", name="admin_show", methods={"GET"})
     */
    public function show(Admin $admin): Response
    {
        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Admin $admin): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Admin $admin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
