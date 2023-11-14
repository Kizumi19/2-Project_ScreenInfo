<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'app_doctor_index', methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findAll();
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

    #[Route('/{id}', name: 'app_doctor_show', methods: ['GET'])]
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
}
