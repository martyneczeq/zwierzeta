<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('age')
            ->add('neutered')
            ->add('medicalRecords')
            ->add('owner', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id',
            ])
            ->add('type', EntityType::class, [
                'class' => \App\Entity\AnimalType::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
