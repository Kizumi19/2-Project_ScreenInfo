<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'label' => 'Correu electrònic',
                    'required' => true,
                ]
            )

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Contrasenya',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                ],
                'second_options' => [
                    'label' => 'Confirmar Contrasenya',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                ],
                'invalid_message' => 'Les contrasenyes han de coincidir.',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
