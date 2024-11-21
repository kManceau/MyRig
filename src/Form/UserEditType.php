<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('age', NumberType::class, [
                'label' => 'Age',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => '00'],
            ])
            ->add('catchphrase', TextType::class, [
                'label' => 'Catchphrase (Optional, 255 characters max)',
                'attr' => ['class' => 'form-control my-2', 'placeholder' => 'Catchphrase'],
                'required' => false,
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Change your avatar (Optional)',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control my-2'],
                'constraints' => [
                    new File([
                        'maxSize' => '32M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml',
                            'image/webp',
                            'image/avif'
                        ],
                        'mimeTypesMessage' => 'Invalid avatar file.',
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
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
