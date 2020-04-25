<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="default")
     */
    public function index()
    {
        return $this->render('/base.html.twig', ['controller_name' => 'DefaultController',]);
    }
}
