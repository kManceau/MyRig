<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Username'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'hash_property_path' => 'password',
                'mapped' => false,
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Password'],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => '00'],
            ])
            ->add('register', SubmitType::class, [
                'label' => 'Register',
                'attr' => ['class' => 'btn btn-primary mt-2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
