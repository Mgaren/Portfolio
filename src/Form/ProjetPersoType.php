<?php

namespace App\Form;

use App\Entity\ProjetPerso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetPersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom*',
            ])
            ->add('link', TextType::class, [
                'label' => 'lien*',
            ])
            ->add('description', TextType::class, [
                'label' => 'description*',
            ])
            ->add('image', FileType::class, [
                'label' => 'image*',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjetPerso::class,
        ]);
    }
}
