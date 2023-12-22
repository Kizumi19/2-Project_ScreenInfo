<?php

namespace App\Controller;

use App\Repository\DoctorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [

        ]);
    }

    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    #[Route('/screen', name: 'app_index_screen')]
    public function screen(DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->createQueryBuilder('d')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult();

        $horaActual = new \DateTime();
        $torn = $horaActual->format('H') < 15 ? 'Morning' : 'Afternoon';

        $filteredSchedules = [];
        $fullSpeciality = [];

        foreach ($doctors as $doctor) {
            foreach ($doctor->getSchedules() as $schedule) {
                if (in_array($torn, $schedule->getShift(), true)) {
                    $filteredSchedules[] = $schedule;
                }
            }
            foreach ($doctor->getSpecialities() as $speciality) {
                $fullSpeciality[] = $speciality;
            }
        }

        return $this->render('screen/index.html.twig', [
            'doctors' => $doctors,
            'fullSchedule' => $filteredSchedules,
            'fullSpeciality' => $fullSpeciality,
            'hora' => $horaActual,
            'torn' => $torn,
        ]);
    }




    #[Route('/current_time', name: 'current_time', methods: ['GET'])]
    public function currentTime(): JsonResponse
    {
        $currentTime = new \DateTime();
        return new JsonResponse(['time' => $currentTime->format('d/m/y H:i')]);
    }
}


