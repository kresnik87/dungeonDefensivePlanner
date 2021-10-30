<?php

namespace App\Controller\Admin;

use App\Entity\Dungeon;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DungeonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dungeon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('imageFile')->setFormType(VichFileType::class, [
                'delete_label' => 'Eliminar?'
            ])->onlyOnForms(),
            ImageField::new('image')->setBasePath('/upload/image/dungeon')->onlyOnDetail(),
            VichImageField::new('imageFile')
        ];
    }
}
