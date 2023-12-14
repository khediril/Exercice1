<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,['label'=>'Nom : ','attr'=>['class'=>'form-control']])
            ->add('price',IntegerType::class,['required' => false,'attr'=>['class'=>'form-control']])
            ->add('description',TextareaType::class,['attr'=>['class'=>'form-control']])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
'choice_label' => 'name','attr'=>['class'=>'form-control']
            ])
            ->add('submit',SubmitType::class,['attr'=>['class'=>'btn btn-primary']])
       /*     ->add('fournisseurs', EntityType::class, [
                'class' => Fournisseur::class,
'choice_label' => 'id',
'multiple' => true,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
