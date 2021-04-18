<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('groups')->hideOnForm()->setLabel('Groupe'),
            ChoiceField::new('roles')
                ->setLabel("Role")
                ->setChoices([
                        'Admin' => 'ROLE_ADMIN',
                        'Utilisateur' => 'ROLE_USER',
                        ])
                        ->allowMultipleChoices(true),
            EmailField::new('email')->hideOnForm()->setLabel('Email'),
            TextField::new('username')->hideOnForm()->setLabel('Pseudo'),
            TextField::new('firstname')->hideOnForm()->setLabel('Prénom'),
            TextField::new('lastname')->hideOnForm()->setLabel('Nom'),
            TextField::new('gender')->hideOnForm()->setLabel('Genre'),
            TextField::new('address')->hideOnForm()->setLabel('Adresse'),
            TextField::new('city')->hideOnForm()->setLabel('Ville'),
            TextField::new('zip')->hideOnForm()->setLabel('Code postal'),
            CountryField::new('country')->hideOnForm()->setLabel('Pays'),
            TextField::new('phone')->hideOnForm()->setLabel('Téléphone'),
            DateField::new('dateofbirth')->hideOnForm()->setLabel('Date de naissance'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Inscrit le'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            // ->remove(Crud::PAGE_INDEX, Action::NEW)
            // ->remove(Crud::PAGE_INDEX, Action:: EDIT)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('groups')
            ->add('email');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->SetDefaultSort(['createdAt' => 'Desc']);
    }
}
