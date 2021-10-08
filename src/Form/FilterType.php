<?php

namespace App\Form;

use App\Entity\Campus;
use App\Model\FilterModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('organizedByMe', CheckboxType::class, [
                'required' => false
            ])
            ->add('mySubscription', CheckboxType::class, [
                'required' => false
            ])
            ->add('tripPassed', CheckboxType::class, [
                'required' => false
            ])
            ->add('notSubscribed', CheckboxType::class, [
                'required' => false
            ])
            ->add('campus', EntityType::class, [
                'label' => 'Campus',
                'class' => Campus::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('nameSearch', TextType::class, [
                'required' => false
            ])
            ->add('dateStartedAt', DateTimeType::class, [
                'attr' => ['class'=> ''],
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('dateEndedAt', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterModel::class,
        ]);
    }
}
