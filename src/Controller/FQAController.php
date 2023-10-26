<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FQAController extends AbstractController
{
    #[Route('/fqa', name: 'fqa')]
    public function index(): Response
    {
        return $this->render('fqa/index.html.twig', [
            'controller_name' => 'FQAController',
        ]);
    }
}
