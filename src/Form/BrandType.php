<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Brand Name',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Brand Name'],
            ])
            ->add('created_at', DateType::class, [
                'html5' => true,
                'label' => 'Creation Date : ',
                'attr' => ['class' => 'form-control my-2'],
            ])
            ->add('history', TextType::class, [
                'label' => 'Brand History',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => ' Brand History'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
