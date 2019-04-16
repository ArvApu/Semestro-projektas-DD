<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 2019-04-13
 * Time: 11:48
 */

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

class SetNewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Naujas slaptažodis'),
                'second_options' => array('label' => 'Pakartokite naują slaptažodį'),
                'invalid_message' => 'Turi sutapti.',
            ))
            ->add('submit', SubmitType::class, array(
                'label'=>'Įrašyti naują slaptažodį'
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