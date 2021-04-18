<?php

namespace App\Controller\Admin;

use App\Entity\Challenge;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChallengeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Challenge::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('session')->setLabel('Session'),
            TextField::new('name')->setLabel('Nom'),
            TextEditorField::new('description')->setLabel('Description'),
            //UrlField::new('image')->setLabel('Image'),
            TextField::new('location')->setLabel('Lieux'),
            IntegerField::new('point')->setLabel('Point(s)'),
            // IntegerField::new('progession')->hideOnForm()->setLabel('Progression'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à')
        ];
    }
}
