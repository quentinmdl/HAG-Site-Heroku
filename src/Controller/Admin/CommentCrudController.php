<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('article')->hideOnForm()->setLabel('Article'),
            TextField::new('author')->hideOnForm()->setLabel('Auteur'),
            TextEditorField::new('content')->hideOnForm()->setLabel('Contenu'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créé à'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action:: EDIT)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('article')
            ->add('author');
    }
}
