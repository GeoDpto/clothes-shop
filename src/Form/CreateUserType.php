<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => new Email([
                    'message' => 'The email \'{{ value }}\' is not a valid email.',
                ]),
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_MANAGER',
                    'User' => 'ROLE_USER',
                ],
                'constraints' => new Choice([
                    'choices' => ['ROLE_USER', 'ROLE_MANAGER', 'ROLE_ADMIN'],
                    'message' => 'Invalid value of choice',
                ]),
            ])
            ->add('passwordHash', RepeatedType::class, [
                'required' => true,
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Enter password'],
                'second_options' => ['label' => 'Repeat password'],
                'constraints' => new Length([
                    'min' => 8,
                    'max' => 30,
                    'minMessage' => 'Your password must be at least {{ limit }} characters long.',
                    'maxMessage' => 'Your password cannot be longer than {{ limit }} characters.',
                ]),
            ])
        ;
    }
}
