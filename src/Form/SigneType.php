<?php

namespace App\Form;

use App\Entity\Signe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SigneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, ['label' => 'Nom du signe'])
            ->add('element', null, ['label' => 'Element (Feu, Terre, etc'])
            ->add('symbole', null, ['label' => 'Symbol astrologique'])
            ->add('dateDebut', null, ['label' => 'Date de début'])
            ->add('dateFin', null, ['label' => 'Date de fin'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signe::class,
        ]);
    }
}
