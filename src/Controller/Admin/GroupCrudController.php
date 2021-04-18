<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Group::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->hideOnForm()->setLabel('Nom'),
            ChoiceField::new('Statut')
                ->setLabel("Statut")
                ->setChoices([
                        'Ouvert' => 'ouvert',
                        'Complet' => 'complet',
                        ])
                ->allowMultipleChoices(true),
            IntegerField::new('score')->hideOnForm()->setLabel('Score'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à'),
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name');
    }
}
