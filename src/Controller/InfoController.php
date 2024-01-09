<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InfoController extends AbstractController
{
    #[Route('/info', name: 'app_info')]
    public function index(): Response
    {
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }
    #[Route('/manual', name: 'download_manual')]
    public function downloadManual(): Response
    {
        $pdfPath = $this->getParameter('kernel.project_dir') . '/public/files/Manual_Del_UsuariFinal_EKRANAS.pdf';

        return new BinaryFileResponse($pdfPath);
    }
}
