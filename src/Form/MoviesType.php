<?php

namespace App\Form;

use App\Entity\Awards;
use App\Entity\Casting;
use App\Entity\Categories;
use App\Entity\Countries;
use App\Entity\Movies;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poster')
            ->add('french_title')
            ->add('original_title')
            ->add('year')
            ->add('prod_countries')
            ->add('duration')
            ->add('pitch')
            ->add('review')
            ->add('awards_won', EntityType::class, [
                'class' => Awards::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('countries', EntityType::class, [
                'class' => Countries::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('castings', EntityType::class, [
                'class' => Casting::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('id_categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}
