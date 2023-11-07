<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Location;
use App\Entity\Schedule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('schedules', CollectionType::class, [
                'entry_type' => ScheduleType::class, // El tipus de formulari que controla cada Horari en la col·lecció
                'entry_options' => ['label' => false],
                'allow_add' => true, // Permet afegir nous formularis a la classe Schedule al formulari Location
                'allow_delete' => true, // Permite eliminar formularis Schedule del formulari Location
                'by_reference' => false, // Asegura que Symfony truqui als métodes adder y remover de la entitat
            ])

            ->add(
                'floor',
                ChoiceType::class,
                [
                    'label' => 'Planta',
                    'required' => true,
                    'multiple' => false,
                    'expanded' => false,
                    'choices' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',

                    ]
                ]

            )
            ->add(
                'room',
                ChoiceType::class,
                [
                    'label' => 'Consulta',
                    'required' => true,
                    'multiple' => false,
                    'expanded' => false,
                    'choices' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
