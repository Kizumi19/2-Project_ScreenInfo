<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Schedule;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'doctor',
                EntityType::class,
                [
                    'label' => 'Doctor',
                    'required' => true,
                    'class' => Doctor::class,
                    'choice_label' => 'getFullName',
                    'multiple' => false,
                    'expanded' => false,
                ]
            )
            ->add(
                'shift',
                ChoiceType::class,
                [
                    'label' => 'Dies',
                    'required' => true,
                    'multiple' => false,
                    'expanded' => true,
                    'choices' => [
                        'Matí' => 'Morning',
                        'Tarda' => 'Afternoon',
                        'Matí i tarde' => 'Morning'.' '.'Afternoon'
                    ]
                ]
            )
            ->add(
                'day',
                ChoiceType::class,
                [
                    'label' => 'Dies',
                    'required' => true,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => [
                        'Dilluns' => 'Monday',
                        'Dimarts' => 'Tuesday',
                        'Dimecres' => 'Wednesday',
                        'Dijous' => 'Thursday',
                        'Divendres' => 'Friday',
                        'Dissabte' => 'Saturday',
                        'Diumenge' => 'Sunday'
                    ]

                ]
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
