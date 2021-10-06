<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Contributor;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('email')
          ->add('firstname', null, ['label' => 'Prénom'])
          ->add('lastname', null, ['label' => 'Nom'])
          ->add('phone', null, ['label' => 'Téléphone'])
//            ->add('enable')
//            ->add('roles')
          ->add('password', null, ['label' => 'mot de passe'])
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
