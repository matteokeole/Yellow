<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer_admin')
            ->add('customer_first_name', TextType::class, [
                'label' => 'Prénom',
                'required' => true
                ])
            ->add('customer_last_name', TextType::class,[
                'label' => 'Nom',
                'required' => true
                ])
            ->add('customer_email', EmailType::class,[
                'label' => 'Email',
                'required' => true
                ])
            ->add('customer_phone', TextType::class,[
                'label' => 'Numéro de téléphone',
                'required' => false
                ])
            ->add('customer_password', PasswordType::class, [
                'label' => 'Mot de passe',
                'required' => true
                ])
            ->add('customer_address', TextType::class,[
                'label' => 'Adresse',
                'required' => true
                ])
            ->add('customer_post_code', IntegerType::class,[
                'label' => 'Code Postal',
                'required' => true
                ])
            ->add('customer_city', TextType::class,[
                'label' => 'Ville',
                'required' => true
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'])
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
