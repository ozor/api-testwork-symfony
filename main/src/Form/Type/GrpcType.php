<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Model\Grpc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrpcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('field1', TextType::class, [
                'label' => 'Field 1',
                'required' => true,
            ])
            ->add('field2', CheckboxType::class, [
                'label' => 'Field 2',
            ])
            ->add('field3', IntegerType::class, [
                'label' => 'Field 3',
                'required' => true,
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grpc::class,
        ]);
    }
}
