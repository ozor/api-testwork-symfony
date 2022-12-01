<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Model\Rest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('field1', TextType::class, [
                'label' => 'Field 1',
            ])
            ->add('field2', CheckboxType::class, [
                'label' => 'Field 2',
                'required' => true,
            ])
            ->add('field3', CollectionType::class, [
                'label' => 'Field 3',
                'required' => true,
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rest::class,
        ]);
    }
}
