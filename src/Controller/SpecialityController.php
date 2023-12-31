<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\Speciality1Type;
use App\Repository\SpecialityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/speciality')]
class SpecialityController extends AbstractController
{
    #[Route('/', name: 'app_speciality_index', methods: ['GET'])]
    public function index(SpecialityRepository $specialityRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pageSize = 10; // Número de elementos por página

        // Obtén la consulta sin ejecutarla aún
        $query = $specialityRepository->createQueryBuilder('d')
            ->orderBy('d.id', 'ASC')
            ->getQuery();

        // Pagina los resultados utilizando el paginador
        $specialities = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $pageSize
        );

        return $this->render('speciality/index.html.twig', [
            'specialities' => $specialities,
        ]);
    }

    #[Route('/new', name: 'app_speciality_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $speciality = new Speciality();
        $form = $this->createForm(Speciality1Type::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($speciality);
            $entityManager->flush();

            return $this->redirectToRoute('app_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('speciality/new.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speciality_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Speciality $speciality): Response
    {
        return $this->render('speciality/show.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_speciality_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speciality $speciality, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Speciality1Type::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_speciality_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speciality_delete', methods: ['POST'])]
    public function delete(Request $request, Speciality $speciality, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speciality->getId(), $request->request->get('_token'))) {
            $entityManager->remove($speciality);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_speciality_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/list/{page}', name: 'speciality_list', methods: ['GET'])]
    public function specialityList(SpecialityRepository $specialityRepository, PaginatorInterface $paginator, Request $request, int $page = 1): Response
    {
        $pageSize = 10;

        $query = $specialityRepository->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->getQuery();

        $specialities = $paginator->paginate(
            $query,
            $page,
            $pageSize
        );

        return $this->render('speciality/index.html.twig', [
            'specialities' => $specialities,
        ]);
    }


}
