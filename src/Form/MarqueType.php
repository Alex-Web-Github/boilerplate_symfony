<?php

namespace App\Form;

use App\Entity\Marque;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MarqueType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('libelle', TextType::class, [
        // 'constraints' => [
        //   new NotBlank([
        //     'message' => 'Veuillez saisir une marque',
        //   ]),
        // ],
        // Retire la vérifi coté Front
        // 'required' => false,

      ])
      // ->add('submit', SubmitType::class)
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Marque::class,
    ]);
  }
}
