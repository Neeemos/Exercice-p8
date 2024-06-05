<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom de la voiture'])
            ->add('description')
            ->add('day_price', NumberType::class, ['label' => 'Prix journalier'])
            ->add('month_price')
            ->add('seat_count', ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => range(1, 12, 1),
                'choice_label' => function ($choice) {
                    return $choice;
                },
            ])
            ->add('transmission', ChoiceType::class, [
                'label' => 'Boîte de vitesse',
                'choices' => [
                    'automatic',
                    'manuel',
                ],'choice_label' => function ($choice) {
                    return $choice;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
