<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('city')
            ->add('zip')
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
                'choices' => array(
                    'M.' => 'Homme',
                    'Mle' => 'Femme',
                ),
                'multiple'=>false,'expanded'=>true,'required' => true,
            ))
            ->add('phone')
            ->add('dateofbirth', BirthdayType::class, array(
                'format' => 'dd-MM-yyyy',
                'years' => range(date('Y')-70, date('Y')-18),
            ))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
