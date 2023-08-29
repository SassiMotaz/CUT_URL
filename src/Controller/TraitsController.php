<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TraitsController extends AbstractController
{
    #[Route('/traits', name: 'app_traits')]
    public function index(): Response
    {
        return $this->render('tarits/traits.html.twig', [
            'controller_name' => 'TraitsController',
        ]);
    }
}
