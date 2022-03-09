<?php

namespace App\Controller\Admin;

use App\Entity\District;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DistrictCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return District::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextField::new('name'),
            IntegerField::new('population')->setFormTypeOptions([
                'attr' =>[
                    'min' => 0,
                ]
            ]),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updateAt')->hideOnForm(),
        ];
    }
}
