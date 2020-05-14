<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Form\RapportType;
use App\Repository\RapportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/rapport")
 */
class RapportController extends AbstractController
{
    /**
     * @Route("/", name="rapport_index", methods={"GET"})
     */
    public function index(RapportRepository $rapportRepository): Response
    {
        return $this->render('rapport/index.html.twig', ['rapports' => $rapportRepository->findAll(),]);
    }

    /**
     * @Route("/home", name="rapport_home", methods={"GET"})
     */
    public function home(RapportRepository $rapportRepository): Response
    {
        return $this->render('rapport/home.html.twig', ['rapports' => $rapportRepository->findAll(),]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="rapport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rapport = new Rapport();
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $rapport->getTitre();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),$fileName);
            $rapport->setTitre($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rapport);
            $em->flush();

            return $this->redirectToRoute('rapport_index');
        }

        return $this->render('rapport/new.html.twig', [
            'rapport' => $rapport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="rapport_show", methods={"GET"})
     */
    public function show(Rapport $rapport): Response
    {
        return $this->render('rapport/show.html.twig', ['rapport' => $rapport,]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="rapport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rapport $rapport): Response
    {
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rapport_index');
        }

        return $this->render('rapport/edit.html.twig', [
            'rapport' => $rapport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="rapport_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rapport $rapport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rapport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rapport_index');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/download/{id}", name="rapport_download", methods={"GET"})
     */
    public function download (RapportRepository $rapportRepository): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $rapport = $rapportRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('rapport/list.html.twig', ['rapport' => $rapport,]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }


}
