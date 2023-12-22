<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Location;
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
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => false,
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
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => [
                        'Matí' => 'Morning',
                        'Tarda' => 'Afternoon',
                    ]
                ]
            )
            ->add(
                'day',
                ChoiceType::class,
                [
                    'label' => 'Dies',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
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

                ])

            ->add(
                'location',
                EntityType::class,
                [
                    'label' => 'Ubicació',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                    'class' => Location::class,
                    'choice_label' => function (Location $location) {
                        return sprintf('Planta: %d, Sala: %s', $location->getFloor(), $location->getRoom());
                    },
                    'multiple' => false,
                    'expanded' => false,
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
