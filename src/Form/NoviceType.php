<?php

namespace App\Form;

use App\Entity\Novice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NoviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Policy' => 'Policy',
                    'Sport' => 'Sport',
                    'Culture' => 'Culture',
                ]
            ])
            ->add('summary', TextType::class)
            ->add('content', TextareaType::class)
            ->add('validFrom', DateType::class)
            ->add('validTill', DateType::class)
            ->add('featured', CheckboxType::class, ['required' => false,]) 
            ->add('published', CheckboxType::class, ['required' => false,])
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Novice::class,
        ]);
    }
}
