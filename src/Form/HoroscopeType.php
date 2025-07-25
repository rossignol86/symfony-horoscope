<?php

namespace App\Form;

use App\Entity\Horoscope;
use App\Entity\Signe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoroscopeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDuJour', null, ['label' => 'Date'])
            ->add('contenu', null, ['label' => 'Message'])
            ->add('signe', EntityType::class, [
                'class' => Signe::class,
                'choice_label' => 'nom',
                'label' => 'Signe astrologique',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horoscope::class,
        ]);
    }
}
