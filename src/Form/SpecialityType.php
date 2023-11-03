<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type_Speciality',
                EntityType::class,
                [
                    'label' => 'Tipus especialitat',
                    'required' => true,
                    'class' => Speciality::class,
                    'choice_label' => 'getTypeSpeciality',
                    'multiple' => false,
                    'expanded' => false,
                ])
            ->add(
                'doctor',
                EntityType::class,
                [
                    'label' => 'Doctor',
                    'required' => true,
                    'class' => Doctor::class,
                    'choice_label' => 'getFullName',
                    'multiple' => true,
                    'expanded' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speciality::class,
        ]);
    }
}
