<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Contributor;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class EditContributorType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('pseudo')
      ->add('email')
      ->add('firstname', null, ['label' => 'Prénom'])
      ->add('lastname', null, ['label' => 'Nom'])
      ->add('phone', null, ['label' => 'Téléphone'])
      ->add('enable', CheckboxType::class, [
        "attr" => [
          "class" => "materialize-textarea"
        ],
        'required' => false
      ])
      ->add('roles', ChoiceType::class, [
        'choices' => [
          'Utilisateur' => 'ROLE_USER',
          'Administrateur' => 'ROLE_ADMIN',
        ],
        'mapped' => false,
      ])
      ->add('password', RepeatedType::class, [
        'type' => PasswordType::class,
        'invalid_message' => 'Les mot de passes doivent correspondre.',
        'options' => ['attr' => ['class' => 'password-field']],
        'required' => true,
        'first_options' => ['label' => 'mot de passe'],
        'second_options' => ['label' => 'confirmation du mot de passe'],
        'constraints' => [
          new Length([
            'min' => 6,
            'minMessage' => 'Votre mot de passe doit contenir au minimum 6 caractères',
            'max' => 32,
            'maxMessage' => 'Votre mot de passe doit contenir au maximum 32 caractères',
          ]),
        ],
      ])
      ->add('campus', EntityType::class, [
        'class' => Campus::class,
        'query_builder' => function (EntityRepository $er) {
          return $er->createQueryBuilder('u')
            ->orderBy('u.name', 'ASC');
        },
        'choice_label' => 'name',
      ])
      //            ->add('trips')
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Contributor::class,
    ]);
  }
}
