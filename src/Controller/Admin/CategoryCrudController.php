<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('description')->setLabel('Description'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créée à'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnForm()->hideOnIndex(),
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
