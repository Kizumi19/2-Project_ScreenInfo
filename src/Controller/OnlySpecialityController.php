<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\Speciality2Type;
use App\Repository\SpecialityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/only/speciality')]
class OnlySpecialityController extends AbstractController
{
    #[Route('/', name: 'app_only_speciality_index', methods: ['GET'])]
    public function index(SpecialityRepository $specialityRepository): Response
    {
        return $this->render('only_speciality/index.html.twig', [
            'specialities' => $specialityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_only_speciality_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $speciality = new Speciality();
        $form = $this->createForm(Speciality2Type::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($speciality);
            $entityManager->flush();

            return $this->redirectToRoute('app_only_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('only_speciality/new.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_only_speciality_show', methods: ['GET'])]
    public function show(Speciality $speciality): Response
    {
        return $this->render('only_speciality/show.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_only_speciality_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speciality $speciality, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Speciality2Type::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_only_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('only_speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_only_speciality_delete', methods: ['POST'])]
    public function delete(Request $request, Speciality $speciality, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speciality->getId(), $request->request->get('_token'))) {
            $entityManager->remove($speciality);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_only_speciality_index', [], Response::HTTP_SEE_OTHER);
    }
}
