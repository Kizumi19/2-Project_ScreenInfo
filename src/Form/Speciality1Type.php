<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Speciality1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type_Speciality')
            ->add('doctor', CollectionType::class, [
                'entry_type' => DoctorType::class, // El tipus de formulari que controla cada Doctor en la col·lecció
                'entry_options' => ['label' => false],
                'allow_add' => true, // Permet afegir nous formularis a la classe Doctor al formulari Speciality
                'allow_delete' => true, // Permite eliminar formularios Doctor del formulario Speciality
                'by_reference' => false, // Asegura que Symfony truqui als métodes adder y remover de la entitat
                 ]);
                }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speciality::class,
        ]);
    }
}
