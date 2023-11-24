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
            ->add(
                'floor',
                ChoiceType::class,
                [
                    'label' => 'Planta',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
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
                TextType::class,
                [
                    'label' => 'Consulta',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}