<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrjectController extends AbstractController
{
    #[Route('/prject/api/', name: 'prject')]
    public function index(): Response
    {
        return $this->render('prject/index.html.twig', [
            'controller_name' => 'PrjectController',
        ]);
    }
}
