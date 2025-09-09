<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Positive;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('description', TextareaType::class)
            ->add('dailyPrice', NumberType::class, [
                'scale' => 2,
                'html5' => true,
                'attr' => ['placeholder' => 'Entrez le prix',
                'min' => 0, ],
                'label' => 'Prix journalier',
                'constraints' => [
                    new Positive([
                        'message' => 'Le prix doit être positif',
                    ]),
                ],
            ])
            ->add('monthlyPrice', NumberType::class, [
                'scale' => 2,
                'html5' => true,
                'label' => 'Prix mensuel',
                'attr' => ['placeholder' => 'Entrez le prix',
                'min' => 0, ],
                'constraints' => [
                    new Positive([
                        'message' => 'Le prix doit être positif',
                    ]),
                ],
            ])
            ->add('places', ChoiceType::class, [
                'choices' => [
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,

                ],
                'label' => 'Nombre de places',
            ])
            ->add('isManual', ChoiceType::class, [
                'choices' => [
                    'Manuelle' => true,
                    'Automatique' => false,

                ],
                'label' => 'Type de boîte',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
