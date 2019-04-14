<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,  ['label' => 'Vartotojo vardas'])
            ->add('email',EmailType::class, ['label' => 'El. paštas'])
            ->add('firstName', TextType::class, ['label' => 'Vardas'])
            ->add('lastName',TextType::class, ['label' => 'Pavardė'])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => true,
                'constraints' =>
                    [
                        new NotBlank(['message' => 'Prašome įvesti slaptažodį']),
                        new Length(
                            [
                                'min' => 6,
                                'minMessage' => 'Slaptažodis turėtu būti bent {{ limit }} simbolių ilgio',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                    ],
                'invalid_message' => 'Slaptažodžiai turi sutapti',
                'first_options'  => array('label' => 'Slaptažodis'),
                'second_options' => array('label' => 'Pakartoti slaptažodį'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}


