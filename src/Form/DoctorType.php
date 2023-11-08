<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Schedule;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                    'required' => true,
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'label' => 'Cognoms',
                    'required' => true,
                ]
            )

            ->add('schedules', CollectionType::class, [
                'label' => 'Horaris',
                'entry_type' => ScheduleEditType::class, // El tipus de formulari que controla cada Doctor en la col·lecció
                'entry_options' => ['label' => false],
                'allow_add' => true, // Permet afegir nous formularis a la classe Doctor al formulari Speciality
                'allow_delete' => true, // Permet eliminar formularis Doctor del formulari Speciality
                'by_reference' => false, // Asegura que Symfony truqui als mètodes adder i remover de la entitat
            ]);

        $builder->add('specialities', EntityType::class, [
            'label' => 'Especialitat',
            'class' => Speciality::class,
            'choice_label' => 'type_speciality',
            'multiple' => true,
            'expanded' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
