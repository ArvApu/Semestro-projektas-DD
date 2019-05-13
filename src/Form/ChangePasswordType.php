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

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class)
            ->add('newPassword', RepeatedType::class, array(
                'type'=>PasswordType::class,
                'first_options' => array('label' => 'Naujas slaptažodis'),
                'second_options' => array('label' => 'Pakartoti nauja slaptažodi'),
                'invalid_message' => 'Nevienodi slaptažodžiai.',
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Pakeisti slaptažodį'
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}