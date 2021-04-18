<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SessionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Session::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom'),
            ChoiceField::new('state')
                ->setLabel("Statut")
                ->setChoices([
                        'Ouvert' => 'ouvert',
                        'Complet' => 'complet',
                        'Finie' => 'finie',
                        ])
                ->allowMultipleChoices(true),
            TextEditorField::new('description')->setLabel('Description'),
            DateTimeField::new('startDate')->setFormat('dd-MM-YY HH:mm')->renderAsChoice()->setLabel('Date de début'),
            DateTimeField::new('endDate')->setFormat('dd-MM-YY HH:mm')->renderAsChoice()->setLabel('Date de fin'),
        ];
    }
}
