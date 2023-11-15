<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Schedule;
use App\Entity\Speciality;
use Doctrine\ORM\EntityRepository;
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
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'label' => 'Cognoms',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                ]
            )

            ->add('schedules', CollectionType::class, [
                'label' => 'Horaris',
                'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                'entry_type' => ScheduleEditType::class, // El tipus de formulari que controla cada Doctor en la col·lecció
                'entry_options' => ['label' => false],
                'allow_add' => true, // Permet afegir nous formularis a la classe Doctor al formulari Speciality
                'allow_delete' => true, // Permet eliminar formularis Doctor del formulari Speciality
                'by_reference' => false, // Asegura que Symfony truqui als mètodes adder i remover de la entitat
            ])

            ->add('specialities', EntityType::class, [
                'label' => 'Especialitats',
                'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                'class' => Speciality::class,
                'choice_label' => function (Speciality $speciality) {
                    return $speciality->getTypeSpeciality();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->where('s.hidden IS NULL')
                        ->orderBy('s.Type_Speciality', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-check-inline',
                ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
