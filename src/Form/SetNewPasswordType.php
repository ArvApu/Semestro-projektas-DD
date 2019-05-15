<?php

namespace App\Form;

use App\Entity\ForgotPassword;
use App\Entity\User;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class SetNewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
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
            ))
                ->add('submit', SubmitType::class, array(
                'label'=>'Įrašyti naują slaptažodį'
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}