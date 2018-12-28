<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('originalPassword', PasswordType::class, array(
                    'label' => 'Current Password',
                    'mapped' => false,
                    'required' => false,
                ))
            ->add('plainPassword',
                PasswordType::class, [
                    'mapped' => false,
                    'constraints' => [
                        new Callback(array($this, 'validateNewPasswords')),
                    ]
                ]
            )
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options'  => array('label' => 'New Password'),
                'second_options' => array('label' => 'Repeat Password'),
                'constraints' => [
                    new Callback(array($this, 'validateNewPasswords')),
                ]
            ))
            ->add('email')
            ->add('firstName')
            ->add('lastName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function validateNewPasswords($value, ExecutionContextInterface $context)
    {
        $form = $context->getRoot();
        // $data = $form->getData();

        if (
            $form['plainPassword'] &&
            ($form['plainPassword']->getData() !== $form['plainPassword']->getData())
        ) {
            $context
                ->buildViolation('The Passwords do not match.ddd')
                ->atPath('plainPassword')
                ->addViolation();
            return false;
        }

        if(!empty($form['plainPassword']->getData())) {
            if (strlen($form['plainPassword']->getData()) < 5) {
                $context
                    ->buildViolation('The password must contain at least 5 characters.')
                    ->atPath('user_plainPassword_first')
                    ->addViolation();
                return false;
            }

            if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/", $form['plainPassword']->getData())) {
                $context
                    ->buildViolation('Use 1 upper case letter, 1 lower case letter, and 1 number.')
                    ->atPath('user_plainPassword_first')
                    ->addViolation();
                return false;
            }
        }

        return true;
    }
}
