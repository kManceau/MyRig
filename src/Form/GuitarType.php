<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Guitar;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuitarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'label' => 'Model Name :',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Model Name'],
            ])
            ->add('created_at', DateType::class, [
                'html5' => true,
                'label' => 'Creation Date : ',
                'attr' => ['class' => 'form-control my-2'],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Description'],
            ])
            ->add('string_number', NumberType::class, [
                'label' => 'Number of strings :',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => '6'],
            ])
            ->add('fret_number', NumberType::class, [
                'label' => 'Number of frets :',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => '21'],
            ])
            ->add('pickups', TextType::class, [
                'label' => 'Pickups :',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Pickups'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guitar::class,
        ]);
    }
}
