<?php

namespace App\Form;

use App\Entity\Campus;
use App\Model\TripModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltersTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                "class" => Campus::class,
                "query_builder" => function(EntityRepository $er) {
                return $er->createQueryBuilder("c")->orderBy("c.name","ASC");
                },
                "choice_label"=>"name"
            ])
            ->add('tripname', TextType::class, [
                "label" => "Le nom de la sortie contient :"
            ])
            ->add('datestart', TextType::class,[
                "label" => "Entre"
            ])
            ->add('dateend', TextType::class,[
                "label" => "Et"
            ])
            ->add('trippromoter', CheckBoxType::class,[
                "label" => "Sorties dont je suis l'organisateur/trice"
            ])
            ->add('tripregistered', CheckBoxType::class,[
                "label" => "Sorties auxquelles je suis inscrit/e"
            ])
            ->add('tripnotregistered', CheckBoxType::class,[
                "label" => "Sorties auxquelles je ne suis pas inscrit/e"
            ])
            ->add('triplimit', CheckBoxType::class,[
                "label" => "Sorties passées"
            ])
        ;


    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

}