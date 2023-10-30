<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Schedule;
use App\Enum\Shift;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
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
                EnumType::class,
                [
                    'label' => 'Torns',
                    'required' => true,
                    'class' => Shift::class
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
