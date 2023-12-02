<?php

namespace App\Form;

use App\Entity\Travel;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TravelType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('country', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
      ])
      ->add('town', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('hotel', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('days', NumberType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('price', NumberType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px', 'step' => '0.1']
      ])
      ->add('all_included', ChoiceType::class, [
        'choices' => ['yes' => 1, 'no' => 0],
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('picture', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
      ])
      ->add('description', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('save', SubmitType::class, [
        'label' => 'Create travel',
        'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Travel::class,
    ]);
  }
}
