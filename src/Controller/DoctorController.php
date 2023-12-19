<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Schedule;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'app_doctor_index', methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pageSize = 10; // Número d'elements per pàgina

        // Agafar la consulta sense executar-la encara
        $query = $doctorRepository->createQueryBuilder('d')
            ->orderBy('d.id', 'ASC')
            ->getQuery();

        // Paginar els resultats utilizant el paginator
        $doctors = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $pageSize
        );

        $fullSchedule = [];
        $fullSpeciality = [];

        foreach ($doctors as $doctor) {
            foreach ($doctor->getSchedules() as $schedule) {
                $fullSchedule[] = $schedule;
            }
        }

        foreach ($doctors as $doctor) {
            foreach ($doctor->getSpecialities() as $speciality) {
                $fullSpeciality[] = $speciality;
            }
        }

        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctors,
            'fullSchedule' => $fullSchedule,
            'fullSpeciality' => $fullSpeciality,
        ]);
    }

    #[Route('/new', name: 'app_doctor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $doctor = new Doctor();

        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($doctor);
            $entityManager->flush();

            return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_doctor_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Doctor $doctor): Response
    {
        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_doctor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Doctor $doctor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Actualizar las relaciones de especialidades del doctor
            $selectedSpecialities = $form->get('specialities')->getData();
            $doctor->setSpecialities($selectedSpecialities);

            $entityManager->flush();

            return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}', name: 'app_doctor_delete', methods: ['POST'])]
    public function delete(Request $request, Doctor $doctor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($doctor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/list/{page}', name: 'doctor_list', methods: ['GET'])]
    public function doctorList(DoctorRepository $doctorRepository, Request $request, PaginatorInterface $paginator, $page = 1): Response
    {
        $pageSize = 10;

        $query = $doctorRepository->createQueryBuilder('d')
            ->orderBy('d.id', 'ASC')
            ->getQuery();

        $doctors = $paginator->paginate(
            $query,
            $page,
            $pageSize
        );

        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctors,
            'currentPage' => $page,
        ]);
    }

    public function searchAjax(Request $request, DoctorRepository $doctorRepository): JsonResponse {
        $searchTerm = $request->query->get('search');
        $results = $doctorRepository->findBySearchTerm($searchTerm);

        $jsonData = [];
        foreach ($results as $doctor) {
            $schedules = []; // Define $schedules aquí
            foreach ($doctor->getSchedules() as $schedule) {
                $schedules[] = [
                    'shift' => $schedule->getShift(),
                    'day' => $schedule->getDay()
                ];
            }


            $specialities = [];
            foreach ($doctor->getSpecialities() as $speciality) {

                $specialities[] = $speciality->getTypeSpeciality();
            }

            $jsonData[] = [
                'id' => $doctor->getId(),
                'name' => $doctor->getName(),
                'surname' => $doctor->getSurname(),
                'schedules' => $schedules,
                'specialities' => $specialities,
            ];
        }

        return $this->json($jsonData);
    }


}
