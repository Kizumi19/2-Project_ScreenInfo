<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/registration', name: 'user_registration', methods: ['GET', 'POST'])]
    public function userRegistration(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash (encriptar) la contraseña
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            );
            $user->setPassword($hashedPassword);

            // Guardar usuario
            $entityManager->persist($user);
            $entityManager->flush();

            // Aquí deberías redirigir al usuario a la página de inicio de sesión,
            // o donde sea apropiado después de un registro exitoso.
            return $this->redirectToRoute('app_login'); // Asegúrate de que esta ruta exista
        }

        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }

}
