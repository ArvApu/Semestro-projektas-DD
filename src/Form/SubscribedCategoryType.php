<?php

namespace App\Form;

use App\Entity\SubscribedCategory;
use App\Entity\User;
use App\Entity\Category;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscribedCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matching', IntegerType::class)
      /*      ->add('categories', CollectionType::class
            )*/
            ->add('categories', EntityType::class,
            [
                'class' => Category::class
            ]
            );
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SubscribedCategory::class,
        ));
    }
}