<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormDoctorController extends AbstractController
{
    #[Route('/formDoctor', name: 'app_form_doctor')]
    public function index(): Response
    {
        return $this->render('form_doctor/index.html.twig', [
            'controller_name' => 'FormDoctorController',
        ]);
    }
}
