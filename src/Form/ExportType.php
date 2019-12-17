<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class ExportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product_id', CheckboxType::class, [
                'label' => 'Is published',
                'required' => false,
                'attr' => ['checked' => 'checked'],
            ])
        ;
    }
}
