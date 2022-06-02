<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TarificationController extends AbstractController
{
    #[Route('/tarification', name: 'app_tarification')]
    public function index(): Response
    {
        return $this->render('tarification/tarification.html.twig', [
            'controller_name' => 'TarificationController',
        ]);
    }
}
