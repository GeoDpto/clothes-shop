<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CreateCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => new Length([
                    'min' => 3,
                    'max' => 50,
                    'minMessage' => 'Min length for category name {{ limit }}',
                    'maxMessage' => 'Max length for category name {{ limit }}',
                ]),
            ])
            ->add('description', TextareaType::class, [
                'constraints' => new Length([
                    'min' => 10,
                    'max' => 255,
                    'minMessage' => 'Min length for category description {{ limit }}',
                    'maxMessage' => 'Max length for category description {{ limit }}',
                ]),
                'required' => false,
            ])
        ;
    }
}
