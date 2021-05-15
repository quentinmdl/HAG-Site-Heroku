<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('city')
            ->add('zip', NumberType::class, [
                'invalid_message' => "Veuillez saisir un code postal",
            ])
            ->add('country', ChoiceType::class, [
                'placeholder' => 'Choisissez un pays',
                'choices' => [
                    'Italie' => 'IT',
                    'Espagne' => 'ES',
                    'Angleterre' => 'EN',
                    'France' => 'FR',
                    'Allemagne' => 'DE',
                    'Belgique' => 'BL',
                    'Suisse' => 'CH',
                ],
                'preferred_choices' => array('France', 'FR'),
            ])
            ->add('gender', ChoiceType::class, array(
                    'choices' => array([
                        'M.' => 'Homme','Mlle' => 'Femme',
                    ]),
                    'label_attr'=>[
                        'class'=>'radio-inline'
                    ],
                'multiple'=>false,'expanded'=>true,'required' => true,
 
            ))
            ->add('phone', TelType::class)
            ->add('dateofbirth', BirthdayType::class, array(
                'format' => 'dd-MM-yyyy',
                'years' => range(date('Y')-70, date('Y')-18),
            ))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Votre mot de passe n'est pas identique",
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
