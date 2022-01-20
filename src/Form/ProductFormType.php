<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product_name', TextType::class, [
                "label" => "Titre *",
                "required" => true
            ])
            ->add('product_author', TextType::class, [
                "label" => "Auteur *",
                "required" => true
            ])
            ->add('product_date', IntegerType::class, [
                "label" => "Date de parution *",
                "required" => true
            ])
            ->add('product_desc', TextareaType::class, [
                "label" => "Description *",
                "required" => true
            ])
            ->add('product_cover', TextType::class, [
                "label" => "Image couverture *",
                "required" => true
            ])
            ->add('product_price', TextType::class, [
                "label" => "Prix *",
                "required" => true
            ])
            ->add('product_stock', IntegerType::class, [
                "label" => "Stock *",
                "required" => true
            ])
            ->add('product_category', TextType::class, [
                "label" => "Catégorie *",
                "required" => true
            ])
            ->add("submit", SubmitType::class, [
                "label" => "Valider"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
