<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            TextareaField::new('description')->setLabel('Description'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating()->setLabel('Image/Vidéo'),
            ImageField::new('file')->setBasePath('/uploads/sessions/')->onlyOnIndex()->setLabel('Image'),
            DateTimeField::new('startDate')->setFormat('dd-MM-YY  H:i')->setLabel('Date de début'),
            DateTimeField::new('endDate')->setFormat('dd-MM-YY  H:i')->setLabel('Date de fin'),
            SlugField::new('slug')->setTargetFieldName('name')->setLabel('Nom pour URL')->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Créée à'),
            DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Modifiée à'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->SetDefaultSort(['createdAt' => 'Desc']);
    }
}
