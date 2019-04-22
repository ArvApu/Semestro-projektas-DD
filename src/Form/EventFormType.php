<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,  ['label' => 'Pavadinimas'])
            ->add('description',TextareaType::class,  ['label' => 'Aprašymas'])
            ->add('category', EntityType::class,
                [
                    'label' => 'Kategorija',
                    'placeholder' => 'Pasirinkti kategorija',
                    'class' => Category::class
                ])
            ->add('date', DateTimeType::class, ["label" => 'Data'])
            ->add('price', MoneyType::class, ["label" => 'Kaina'])
            ->add('location',TextType::class,  ['label' => 'Vieta'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
