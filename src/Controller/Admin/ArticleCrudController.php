<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('description')->setLabel('Contenu'),
            AssociationField::new('category')->setLabel('Catégorie(s)'),
            UrlField::new('image')->setLabel('Image/Vidéo'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à'),
        ];
    }
    

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->SetDefaultSort(['createdAt' => 'Desc']);
    }
}
