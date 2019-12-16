<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;

class CreateProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class, ['required' => false])
            ->add('price', MoneyType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
            ])
            ->add('mainImage', FileType::class, [
                'multiple' => false,
                'required' => false,
                'label' => 'Choose main image for product.',
                'constraints' => new Image([
                    'maxSize' => '2048k',
                ]),
            ])
            ->add('images', FileType::class, [
                'multiple' => true,
                'required' => false,
                'label' => 'Choose images for product.',
                'constraints' => new All([
                    new Image(['maxSize' => '2048k']),
                ]),
            ])
        ;
    }
}
