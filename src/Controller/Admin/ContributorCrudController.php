<?php

namespace App\Controller\Admin;

use App\Entity\Contributor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ContributorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contributor::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname', 'Prenom'),
            TextField::new('lastname', 'Nom'),
            TextField::new('email'),
            TextField::new('phone'),
            TextField::new('password')->setFormType(PasswordType::class),
            BooleanField::new('enable'),
            ArrayField::new('roles'),
        ];
    }

}
