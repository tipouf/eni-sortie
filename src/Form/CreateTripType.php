<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Location;
use App\Entity\Trip;
use App\Model\TripModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //$cityId = $builder->getData()->
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la sortie',
            ])
            ->add('startedAt', TextType::class, [
                'label' => 'Commence le',
                "attr" => [
                    "class" => "datepicker"
                ]
            ])
            ->add('startedAtTime', TextType::class, [
                'label' => 'à',
                "attr" => [
                    "class" => "timepicker"
                ]
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée (en min.)',
            ])
            ->add('registrationLimit',TextType::class, [
                'label' => "Date limite d'inscription le",
                "attr" => [
                    "class" => "datepicker"
                ]
            ])
            ->add('registrationLimitTime', TextType::class, [
                'label' => 'à',
                "attr" => [
                    "class" => "timepicker"
                ]
            ])
            ->add('registrationNumber', IntegerType::class, [
                'label' => 'Nombre de place max.',
            ])
            ->add('description', TextareaType::class, [
                "attr" => [
                    "class" => "materialize-textarea"
                ]
            ])
            ->add('promoter', EntityType::class, [
                'label' => 'Campus',
                'class' => Campus::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('city', EntityType::class, [
                'label' => 'Ville',
                'class' => City::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('location', EntityType::class, [
                'label' => 'Lieu',
                'class' => Location::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'attr' => [
                    'disabled' => true
                ],
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('newLocation', CheckboxType::class, [
                "attr" => [
                    "class" => "materialize-textarea"
                ],
                'required' => false
            ])
            ->add('locationType', LocationType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TripModel::class,
        ]);
    }
}
