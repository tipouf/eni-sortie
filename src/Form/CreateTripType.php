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
        $builder
            ->add('name', TextType::class)
            ->add('startedAt', TextType::class, [
                "attr" => [
                    "class" => "datepicker"
                ]
            ])
            ->add('startedAtTime', TextType::class, [
                "attr" => [
                    "class" => "timepicker"
                ]
            ])
            ->add('duration', IntegerType::class)
            ->add('registrationLimit',TextType::class, [
                "attr" => [
                    "class" => "datepicker"
                ]
            ])
            ->add('registrationLimitTime', TextType::class, [
                "attr" => [
                    "class" => "timepicker"
                ]
            ])
            ->add('registrationNumber', IntegerType::class)
            ->add('description', TextareaType::class, [
                "attr" => [
                    "class" => "materialize-textarea"
                ]
            ])
            ->add('promoter', EntityType::class, [
                'class' => Campus::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('newLocation', CheckboxType::class, [
                "attr" => [
                    "class" => "materialize-textarea"
                ],
                'required' => false
            ])
            ->add('locationType', LocationType::class)

            ->add('city', EntityType::class, [
                'class' => City::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
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
