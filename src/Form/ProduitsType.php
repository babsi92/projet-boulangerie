<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    'Patisserie' => 'Patisserie',
                    'Viennoiseries' =>'Viennoiseries',
                    'Pains'  => 'Pains',
                    'Sandwichs' => 'Sandwichs',
                    'Boissons' => 'Boissons',
                ]
            ])
            ->add('Nom', TextType::class)
            ->add('Description', TextareaType::class)
            ->add('imageFile', FileType::class,[
                'required' => false
                        ])
            ->add('Prix', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
