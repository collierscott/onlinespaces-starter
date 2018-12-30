<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a username.'
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'THe username must contain at least 3 characters.'
                        ])
                    ]
                ]
            )
            ->add('email', EmailType::class)
            ->add('plainPassword',
                PasswordType::class, [
                    'mapped' => false,
                    'label' => 'Password',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password.'
                        ]),
                        new Length([
                            'min' => 5,
                            'minMessage' => 'The password must contain at least 5 characters.'
                        ])
                    ]
                ]
            )
            ->add('agreeTerms', CheckboxType::class, [
                    'mapped' => false,
                    'label' => 'Agree to the Terms and Policies',
                    'constraints' => [
                        new IsTrue([
                            'message' => 'You must agree to the terms.'
                        ])
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
