<?php

namespace App\Form;

use App\Entity\Schedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'shift',
                ChoiceType::class,
                [
                    'label' => 'Dies',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 15px;'],
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
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 15px;'],
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

                ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
