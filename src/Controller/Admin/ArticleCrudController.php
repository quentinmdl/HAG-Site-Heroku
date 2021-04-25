<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
            TextareaField::new('content')->setLabel('Contenu'),
            AssociationField::new('category')->setLabel('Catégorie(s)'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating()->setLabel('Image/Vidéo'),
            ImageField::new('file')->setBasePath('/uploads/articles/')->onlyOnIndex()->setLabel('Image'),
            SlugField::new('slug')->setTargetFieldName('title')->setLabel('Titre pour URL')->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à'),
            DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Modifié à'),
            TextField::new('createdBy')->hideOnForm()->setLabel('Créé par'),
            TextField::new('updatedBy')->hideOnForm()->setLabel('Modifié par'),
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
