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
    private function consultesTotal(){
        $consultes = [];
        for ($i = 1; $i <= 32; $i++) {
            $consultes[] = $i;
        }
        return $consultes;
    }
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
                        'Planta 0' => '0',
                        'Planta 1' => '1',
                        'Planta 2' => '2',
                        'Planta 3' => '3',
                        'Planta 4' => '4',
                        'Planta 5' => '5',
                    ]
                ]

            )
            ->add(
                'room',
                ChoiceType::class,
                [
                    'label' => 'Consulta',
                    'label_attr' => ['style' => 'font-weight: bold; color: #333; font-size: 18px;'],
                    'required' => true,
                    'choices' => $this->consultesTotal(),
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