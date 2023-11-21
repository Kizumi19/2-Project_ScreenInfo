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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    private function getFloorChoices()
    {
        return [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
        ];
    }
    private function getRoomChoices($floor)
    {
        $roomsByFloor = [
            '0' => range(1, 15),
            '1' => range(16, 26),
            '4' => range(28, 31),
        ];

        return array_flip($roomsByFloor[$floor] ?? []);
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
                    'choices' => $this->getFloorChoices(),
                ]

            );

        $formModifier = function (FormEvent $event) {
            $location = $event->getData();
            $form = $event->getForm();

            $rooms = null === $location ? [] : $this->getRoomChoices($location->getFloor());

        }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
