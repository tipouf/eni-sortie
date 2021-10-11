<?php

namespace App\Controller\Admin;

use App\Entity\Contributor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            TextField::new('pseudo'),
            ArrayField::new('roles')
        ];
    }

}
