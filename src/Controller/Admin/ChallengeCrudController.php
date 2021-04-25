<?php

namespace App\Controller\Admin;

use App\Entity\Challenge;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            TextareaField::new('description')->setLabel('Description'),
            TextField::new('location')->setLabel('Lieux'),
            IntegerField::new('point')->setLabel('Point(s)'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating()->setLabel('Image/Vidéo'),
            ImageField::new('file')->setBasePath('/uploads/challenges/')->onlyOnIndex()->setLabel('Image'),
            // IntegerField::new('progession')->hideOnForm()->setLabel('Progression'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnForm()->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à'),
            DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Modifié à')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->SetDefaultSort(['createdAt' => 'Desc']);
    }
}
