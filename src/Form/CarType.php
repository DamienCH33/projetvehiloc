<?php

namespace App\Form;

use App\Entity\Car;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// ...

$builder->add('isAttending', ChoiceType::class, [
    'choices'  => [
        'Maybe' => null,
        'Yes' => true,
        'No' => false,
    ],
]);
// ...

$builder->add('price', MoneyType::class, [
    'divisor' => 100,
]);

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('dailyPrice', MoneyType::class, ['currency' => 'EUR'])
            ->add('monthlyPrice', MoneyType::class, ['currency' => 'EUR'])
            ->add('places', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ],
            ])
            ->add('isManual', ChoiceType::class, [
                'choices' => [
                    'Manuelle' => true,
                    'Automatique' => false,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
